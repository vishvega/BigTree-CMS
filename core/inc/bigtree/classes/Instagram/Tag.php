<?php
	/*
		Class: BigTree\Instagram\Tag
			An Instagram object that contains information about and methods you can perform on a tag.
	*/

	namespace BigTree\Instagram;

	class Tag {

		/** @var \BigTree\Instagram\API */
		protected $API;

		public $MediaCount;
		public $Name;

		/*
			Constructor:
				Creates a tag object from Instagram data.

			Parameters:
				tag - Instagram data
				api - Reference to the BigTree\Instagram\API class instance
		*/

		function __construct($tag,&$api) {
			$this->API = $api;
			isset($tag->media_count) ? $this->MediaCount = $tag->media_count : false;
			isset($tag->name) ? $this->Name = $tag->name : false;
		}

		/*
			Function: getMedia
				Alias for BigTree\Instagram\API::getTaggedMedia
		*/

		function getMedia() {
			return $this->API->getTaggedMedia($this->Name);
		}

	}
	