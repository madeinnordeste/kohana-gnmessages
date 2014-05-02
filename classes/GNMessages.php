<?php defined('SYSPATH') OR die('No direct script access.');

class GNMessages{

	var $username = '';
	var $password = '';
	var $tag = '';

	const URL_ATOM = 'https://#USERNAME#:#PASSWORD#@mail.google.com/mail/feed/atom/#TAG#';

	public function __construct($username, $password, $tag='')
	{
		$this->username = urlencode($username);
		$this->password = $password;
		$this->tag = $tag;
	}

	private function make_url()
	{
		$url = self::URL_ATOM;
		$url =  str_replace('#USERNAME#', $this->username, $url);
		$url =  str_replace('#PASSWORD#', $this->password, $url);
		$url =  str_replace('#TAG#', $this->tag, $url);
		return $url;
	}

	private function atom_2_array($feed)
	{
		$xml = simplexml_load_string($feed);
		$data['entries'] = array();
		$data['title'] = (string)$xml->title;
		$data['fullcount'] = (int)$xml->fullcount;
		$data['tagline'] = (string)$xml->tagline;
		$data['modified'] = (string)$xml->modified;
		foreach ($xml->entry as $entry){
		    $current_entry = array();
    		$current_entry['author'] = array();
    		$current_entry['contributor'] = array();
    		$current_entry['title'] = (string)$entry->title;
		    $current_entry['summary'] = (string)$entry->summary;
		    $current_entry['link'] = (string)$entry->link['href'];
		    $current_entry['modified'] = (string)$entry->modified;
		    $current_entry['issued'] = (string)$entry->issued;
		    $current_entry['id'] = (string)$entry->id;
		    $current_entry['author']['name'] = (string)$entry->author->name;
		    $current_entry['author']['email'] = (string)$entry->author->email;
		    $current_entry['contributor']['name'] = (string)$entry->contributor->name;
		    $current_entry['contributor']['email'] = (string)$entry->contributor->email;
		    $data['entries'][] = $current_entry;
		}
		return $data;
	}

	public function get()
	{
		$url = $this->make_url();
		$options = class_exists('Cache') ? array('cache' => Cache::instance()) : array();
        $feed = Request::factory($url, $options)->execute()->body();
        return $this->atom_2_array($feed);
	}

}