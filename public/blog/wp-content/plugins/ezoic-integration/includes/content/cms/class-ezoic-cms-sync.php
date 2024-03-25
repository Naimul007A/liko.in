<?php

namespace Ezoic_Namespace;

class Ezoic_CMS_Sync {

	public function ez_cms_sync_options_endpoint() {
		register_rest_route( 'ezoic-cms/v1', '/sync/options', array(
			'methods' => \WP_REST_Server::EDITABLE,
			'callback' => array( $this, 'ez_cms_sync_options' ),
			'permission_callback' => '__return_true',
			'show_in_index'       => false,
		));
	}

	public function ez_cms_sync_origin_theme_endpoint() {
		register_rest_route( 'ezoic-cms/v1', '/sync/theme', array(
			'methods' => \WP_REST_Server::EDITABLE,
			'callback' => array( $this, 'ez_cms_sync_origin_theme' ),
			'permission_callback' => '__return_true',
			'show_in_index'       => false,
		));
	}

	public function ez_cms_sync_linklists_endpoint() {
		register_rest_route( 'ezoic-cms/v1', '/sync/linklists', array(
			'methods' => \WP_REST_Server::EDITABLE,
			'callback' => array( $this, 'ez_cms_get_menus_and_send' ),
			'permission_callback' => '__return_true',
			'show_in_index'       => false,
		));
	}

	public function ez_cms_sync_origin_theme() {
		$theme_urls = array();

		$posts = get_posts( array(
			'post_status'	=> 'publish',
			'numberposts'	=> 1,
		));
		if ( $posts ) {
			$post = $posts[0];
			$theme_urls['post_url'] = get_permalink( $post->ID );
		} else {
			error_log( '[CMS SYNC] Unable to retrieve a post URL' );
		}

		// Get a category page w/ at least one post
		$categories = get_categories( array(
			'number'		=> 1,
			'hide_empty'	=> true,
		));
		if ( $categories ) {
			$category = $categories[0];
			$theme_urls['collection_url'] = get_category_link( $category->term_id );
		} else {
			// Unable to find a category w/ at least one post
			// Try to find a tag collection w/ at least one post
			$tags = get_tags( array(
				'number'		=> 1,
				'hide_empty'	=> true,
			));
			if ( $tags ) {
				$tag = $tags[0];
				$theme_urls['collection_url'] = get_tag_link( $tag->term_id );
			} else {
				error_log( '[CMS SYNC] Unable to retrieve a collection page URL' );
			}
		}

		$pages = get_pages( array(
			'number'		=> 1,
			'post_type'		=> 'page',
			'post_status'	=> 'publish'
		));
		if ( $pages ) {
			$page = $pages[0];
			$theme_urls['page_url'] = get_page_link( $page->ID );
		} else {
			error_log( '[CMS SYNC] Unable to retrieve a static page URL' );
		}

		$theme_urls['home_url'] = get_bloginfo( 'url' );

		return Ezoic_Content_Request::send_sync_theme( $theme_urls );
	}

	public function ez_cms_sync_options() {
		$options = wp_load_alloptions();
		return Ezoic_Content_Request::send_sync_options( $options );
	}

	public function ez_cms_get_menus_and_send() {
		$linklists = $this->get_all_menus();

		return Ezoic_Content_Request::send_sync_linklists( $linklists );
	}


	/**
	 * @access public
	 * @param string
	 * This function processes the data of a new insert to 'Categories' or 'Tags' and sends
	 * it to pub's Ezoic CMS in an HTTP request
	 */
	public function term_added( $term_id ) {
		$body = $this->term_db_query( $term_id );
		$body = $this->format_term_body( $body );
		$slug = $body['slug'];
		$method = 'POST';
		$endpoint = $this->determine_endpoint( $body['taxonomy'], $slug, $method );
		$body = json_encode($body, JSON_UNESCAPED_SLASHES);
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log( "[CMS SYNC] $result");
		}
	}

	/**
	 * @access public
	 * @param string
	 * This function processes the updated data of a new update to 'Categories' or 'Tags' and sends
	 * it to pub's Ezoic CMS in an HTTP request
	 */
	public function term_updated( $term_id ) {
		$body = $this->term_db_query( $term_id );
		$body = $this->format_term_body( $body );
		$id = $body['term_id'];
		$method = 'PUT';
		$endpoint = $this->determine_endpoint( $body['taxonomy'], $id, $method );
		$body = json_encode($body, JSON_UNESCAPED_SLASHES);
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if( $result !== true ){
			error_log( "[CMS SYNC] $result" );
		}
	}

	/**
	 * This function processes the deletion of an entry from 'Categories' or 'Tags' and sends
	 * the term_id in an HTTP request to pub's Ezoic CMS
	 */
	public function term_deleted( $term_id ) {
		$body = $this->term_db_query( $term_id );
		$method = 'DELETE';
		$endpoint = $this->determine_endpoint( $body['taxonomy'], $term_id, $method );
		$body = json_encode($body, JSON_UNESCAPED_SLASHES);
		$result = $this->send_sync_request( $endpoint, $method, "" );
		if ($result !== true) {
			error_log( "[CMS SYNC] $result" );
		}
	}
	/**
	 * @access public
	 * @param object the WP_post_obj is a custom class which contains the full 'post' database object
	 */
	public function post_added( $WP_post_obj ) {
		$body = $this->get_post_by_id( $WP_post_obj->ID );
		// format the post body
		$body = $this->format_post_body( $body );
		$method = 'POST';
		$endpoint = $this->page_post_endpoint( $body, $method );
		$body = json_encode($body, JSON_UNESCAPED_SLASHES);
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ( $result !== true ) {
			error_log( "[CMS SYNC] $result" );
		}
	}

	/**
	 * @access public
	 * @param object the WP_post_obj is a custom class which contains the full 'post' database object
	 */
	public function post_updated( $WP_post_obj ) {
		$body = $this->get_post_by_id($WP_post_obj->ID);
		$body = $this->format_post_body( $body );
		$method = 'PUT';
		$endpoint = $this->page_post_endpoint( $body, $method );
		$body = json_encode($body, JSON_UNESCAPED_SLASHES);
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log($result);
		}
	}

	public function post_saved( $post_id, $post, $update ) {
		// If this is just a revision or autosave, we can ignore it.
		if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id )) {
			return;
		}

		$method = 'POST';
		if ( $update ) {
			$method = 'PUT';
		}

		$post_array = $post->to_array();
		//$body  = $this->get_post_by_id( $post_id );
		$body = $this->format_post_body( $post_array );
		$endpoint = $this->page_post_endpoint( $body, $method );
		$body = json_encode($body, JSON_UNESCAPED_SLASHES);
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log($result);
		}
	}


	/**
	 * @access public
	 * @param object the WP_post_obj is a custom class which contains the full 'post' database object
	 */
	public function post_deleted( $WP_post_obj ) {
		$body = $this->get_post_by_id($WP_post_obj->ID);
		$method = 'DELETE';
		$endpoint = $this->page_post_endpoint( $body, $method );
		$result = $this->send_sync_request( $endpoint, $method, "" );
		if ($result !== true) {
			error_log($result);
		}
	}

	public function user_deleted( $user_id ) {
		$method = 'DELETE';
		$endpoint = $this->determine_endpoint( 'users', $user_id, $method );
		$result = $this->send_sync_request( $endpoint, $method, "" );
		if ($result !== true) {
			error_log("Error: " . $result);
		}
	}

	public function user_created( $user_id, $user_data) {
		// Remove the plaintext password from the data
		$user_data['user_pass'] = "";
		$user_data['user_id'] = $user_id;
		$file = fopen("user_created.txt", "w");
		fwrite($file, json_encode( $user_data, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK ));
		fclose($file);
		$method = 'POST';
		$endpoint = $this->determine_endpoint( 'users', $user_id, $method );
		$body = json_encode( $user_data, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK );
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log("Error: " . $result);
		}
	}

	public function user_updated( $user_id, $old_user_data, $user_data ) {
		// Remove the plaintext password from the data
		$user_data['user_pass'] = "";
		$user_data['user_id'] = $user_id;
		$method = 'PUT';
		$endpoint = $this->determine_endpoint( 'users', $user_id, $method );
		$body = json_encode( $user_data, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK );
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log("Error: " . $result);
		}
	}

	public function menu_added( $menu_id ) {
		$query_body = $this->term_db_query($menu_id);
		$body = $this->get_all_menus();
		$method = 'POST';
		$endpoint = $this->determine_endpoint( $query_body['taxonomy'], $menu_id, $method );
		$body = json_encode($body, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log("Error: " . $result);
		}
	}

	public function menu_updated( $menu_id ) {
		$query_body = $this->term_db_query($menu_id);
		$body = $this->get_all_menus();
		$body = json_encode($body, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
		$method = 'POST';
		$endpoint = $this->determine_endpoint( $query_body['taxonomy'], $menu_id, $method );
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log("Error: " . $result);
		}
	}

	public function menu_deleted( $menu_id ) {
		$body = $this->get_all_menus();
		$body = json_encode($body, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
		$method = 'POST';
		$endpoint = $this->determine_endpoint( 'nav_menu', $menu_id, $method );
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log("Error: " . $result);
		}
	}

	/**
	 * This is to formalize the link between a tag/category and its post. Any time the
	 * postmeta changes, we can change the corresponding relations table on Ezoic CMS
	 */
	public function ez_cms_add_term_rel( $object_id ) {
		$term_relationships = $this->term_rel_db_query( $object_id );
		$term_relationships["post_id"] = $object_id;
		$term_relationships["source_type"] = "wordpress";
		$method = 'POST';
		$endpoint = $this->determine_endpoint( "wp_term_rel", "", $method );
		$body = json_encode($term_relationships, JSON_UNESCAPED_SLASHES);
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log($result);
		}
	}

	public function ez_cms_delete_term_rel( $object_id ) {
		$term_relationships = $this->term_rel_db_query( $object_id );
		$term_relationships["post_id"] = $object_id;
		$term_relationships["source_type"] = "wordpress";
		$method = 'PUT';
		$endpoint = $this->determine_endpoint( 'wp_term_rel', "", $method );
		$body = json_encode($term_relationships, JSON_UNESCAPED_SLASHES);
		$result = $this->send_sync_request( $endpoint, $method, $body );
		if ($result !== true) {
			error_log( "[CMS SYNC] $result" );
		}
	}

	/**
	 * @param object a WP_post_obj, which comes through the WP action, not through a DB query.
	 *
	 * this func makes it possible to use determine endpoint with a WP_post_obj
	 */
	private function page_post_endpoint( $body, $method ) {
		$endpoint = null;
		if( $body["post_type"] === 'page' ) {
			$endpoint = $this->determine_endpoint( 'page', $body["ID"], $method );
		} else {
			$endpoint = $this->determine_endpoint( 'post', $body["ID"], $method );
		}
		return $endpoint;
	}

	/**
	 * @access private
	 * @param object the WP_post_body object which is a representation of an entire post/page database entry
	 * @return object the WP_post_body object with the necessary fields (for Ezoic CMS) added
	 */
	private function format_post_body( $body ) {
		$post_title = $body["post_title"];
		$post_title = implode("-", explode(" ", $post_title));
		$body["slug"] = $post_title;
		$body["title"] = $body["post_title"];

		$post_id = $body["ID"];

		$image_id = get_post_thumbnail_id( $post_id );
		$image = wp_get_attachment_image_src( $image_id, 'single-post-thumbnail' );
		if ( isset( $image ) && $image !== '' && is_array( $image ) ) {
			$body['featured_image'] = array(
				'url' => $image[0],
				'width' => $image[1],
				'height' => $image[2],
				'id' => $image_id,
				'source_type' => 'wordpress'
			);
		}

		$excerpt = get_the_excerpt( $post_id );
		if ( isset( $excerpt ) && $excerpt !== '' ) {
			$body["excerpt_html"] = '<p>' . $excerpt . '</p>';
		}

		$body["content_html"] = $body["post_content"];
		$body["source_type"] = "wordpress";
		$body["timezone"] = wp_timezone_string();
		$body["categories"] = wp_get_post_categories( $post_id, array( 'fields' => 'all' ));
		$body ["tags"] = wp_get_post_tags( $post_id );
		return $body;
	}

	/**
	 * @access private
	 * changing certain field names in Tag
	 * @param array The body object from the DB
	 */
	private function format_term_body( $body ) {
		$body["title"] = $body["name"];
		$desc = $body["description"];
		$body["description_html"] = "<p>$desc</p>";
		$body["source_type"] = "wordpress";
		return $body;
	}

	/**
	 * @access private
	 * @param string $contentType: specifies what content-type is being sent
	 * @param string $id: specifies the unique id of the entity
	 * @param string $method: the HTTP verb
	 * A method to handle forming the request endpoint to be supplied to
	 * send_sync_request
	 */
	private function determine_endpoint( $contentType, $id, $method ) {
		$endpoint = "";
		if( $contentType === "post_tag" ) {
			$endpoint = $endpoint . "/tags";
		} elseif ( $contentType === "category") {
			$endpoint = $endpoint . "/categories";
		} elseif ( $contentType === "post" ) {
			$endpoint = $endpoint . "/posts";
		} elseif ( $contentType === "upload" ) {
			$endpoint = $endpoint . "/uploadfile";
		} elseif ( $contentType === "page" ) {
			$endpoint = $endpoint . "/pages";
		} elseif ( $contentType === "wp_term_rel" ) {
			$endpoint = $endpoint . "/termrelationship";
		} elseif ( $contentType === "nav_menu" ) {
			$endpoint = $endpoint . "/linklists";
		} elseif ( $contentType === "users") {
			// TODO: create the users endpoint
			$endpoint = $endpoint . "/users";
		}

		if( $method === 'PUT' || $method === 'DELETE' ) {
			$endpoint = $endpoint . "/$id";
		}
		return $endpoint;
	}

	/**
	 * @access public
	 * @param string $endpoint
	 * @param string $method
	 * @param array $body: the result of the DB query to be sent to the Ezoic CMS server
	 * A function for making an HTTP request which returns the remote server response
	 * Need to add proper error handling
	 */
	public function send_sync_request( $endpoint, $method, $body ) {
		$request = array(
			"method" => $method,
			"headers" => array(
				"Content-Type" => "application/json",
				"X-Ezoic-CMS-Sync" => "true",
			),
		);

		if ( $method !== 'DELETE' ) {
			$request['body'] = $body;
		}

		$response = Ezoic_Content_Request::send_request( $endpoint, $request );

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			return $error_message;
		}

		return true;
	}

	public function logo_update() {
		Ezoic_CMS_Sync::logo_force_update("false");
	}

	public function logo_force_update($force) {
		if ( has_custom_logo() ) {
			// If custom logo exists, get information from wp and put in image object
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

			// Body request for image size
 			$ch = curl_init($image[0]);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, TRUE);
			curl_setopt($ch, CURLOPT_NOBODY, TRUE);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_exec($ch);
			$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
			curl_close($ch);

			// Send info to hw
			Ezoic_CMS_Sync::send_logo_update( $image[0], $size, $force );
		}
	}

	public static function send_logo_update( $logourl, $size, $force ) {
		// Send logo info to CMS
		$body = array (
			'payload' => array(
				'logo' 	=> $logourl,
				'size'	=> $size,
				'force' => $force,
			)
		);

		$request = array(
			'timeout'	=> 30,
			'method'	=> 'POST',
			'body'		=> json_encode( $body ),
			'headers'	=> array(
				'Content-Type' 			=> 'application/json',
			),
		);

		$backend_url = "/api/v1/tenants/%s/workers/site/logo/update";

		$url = sprintf($backend_url, Ezoic_Content_Util::get_id());

		return Ezoic_Content_Request::send_backend_request( $url, $request );
	}

	private function get_post_by_id( $post_id ) {
		global $wpdb;
		$sql = <<< SQL
		SELECT * from wp_posts
		WHERE ID = $post_id
SQL;
		$post_object = $wpdb->get_results( $sql, ARRAY_A )[0];
		return $post_object;
	}

	/**
	 * Function to access each menus menu items
	 */

	private function wp_get_menu_array($current_menu) {
		$menu_array = wp_get_nav_menu_items($current_menu);
		$menu = array();

		foreach ($menu_array as $m) {
			$type = $m->object;
			if ($type === 'custom') {
				$type = "url";
			};
			if (empty($m->menu_item_parent)) {
				$menu_item = array();
				$menu_item['id'] = $m->ID;
				$menu_item['title'] = $m->title;
				$menu_item['url'] = $m->url;
				$menu_item['type'] = $type;
				$menu_item['position'] = $m->menu_order - 1;
				$menu_item['links'] = $this->populate_children($menu_array, $m);
				if (sizeof($menu_item['links']) > 0) {
					$menu_item['levels'] = 1;
				}
				array_push($menu, $menu_item);
			}
    	}
    	return $menu;
	}

	private function populate_children($menu_array, $menu_item) { {
			$children = array();
			if (!empty($menu_array)){
				foreach ($menu_array as $k=>$m) {
					$type = $m->object;
					if ($type === 'custom') {
						$type = "url";
					};
					if ($m->menu_item_parent == $menu_item->ID) {
						$submenu_item = array();
						$submenu_item['id'] = $m->ID;
						$submenu_item['title'] = $m->title;
						$submenu_item['url'] = $m->url;
						$submenu_item['type'] = $type;
						$submenu_item['position'] = $m->menu_order - 1;
						$submenu_item['links'] = $this->populate_children($menu_array, $m);
						if (sizeof($submenu_item['links']) > 0) {
							$submenu_item['levels'] = 1;
						}
						array_push($children, $submenu_item);
					}

				}
			};
			return $children;
		}
	}

	/**
	 * Function to get each menu
	 */

	public function get_all_menus() {
		$menus = wp_get_nav_menus();
		$linklist = array();
		global $wp;
		$domain = home_url( $wp->request );
		$domain = wp_parse_url( $domain )['host'];
		foreach($menus as $menu) {
			$item = array(
				'title' => $menu->name,
				'slug' => $menu->slug,
				'levels' => $menu->count,
				'links' => array()
			);
			$item['links'] = $this->wp_get_menu_array($menu);
			array_push($linklist, $item);
		}
		return $linklist;
	}

	/**
	 * @access private
	 * @param string $term_id
	 * @return array
	 * The wp_terms and wp_term_taxonomy tables store Tags and Categories
	 * This is a utility function for querying on Term POST or PUT
	 * Joins the wp_terms and wp_term_taxonomy tables to provide all relevent data
	 * on the newly created or edited Tag or Category
	 */
	private function term_db_query( $term_id ) {
		global $wpdb;

		$sql = <<<SQL
		SELECT wpt.term_id, name, slug, term_group, description, taxonomy, parent, count, term_taxonomy_id
		FROM wp_terms AS wpt
		INNER JOIN wp_term_taxonomy AS wptt ON wptt.term_id = wpt.term_id
		WHERE wpt.term_id = $term_id
SQL;

		$row = $wpdb->get_results( $sql, ARRAY_A )[0];
		return $row;
	}

	/**
	 * @param string
	 * @return array
	 */
	private function attachment_db_query( $post_id ) {
		global $wpdb;
		$sql = <<<SQL
		SELECT * FROM wp_postmeta
		WHERE post_id = $post_id
SQL;

		$row = $wpdb->get_results( $sql, ARRAY_A )[0];
		return $row;
	}

	/**
	 * @access private
	 * @param int the id of the page or post
	 * Uses page/post id to find out which tags/categories are on it. Using this as a way to send updated tag/category relationships to
	 * Ezoic CMS, however I see no way to avoid sending all entries, as timestamp is not specified on the wp_term_rels
	 * Thus, I'm sending them all over and inserting the ones that don't already exist.
	 */
	private function term_rel_db_query( $post_page_id ) {
		global $wpdb;
		$sql = <<< SQL
		SELECT object_id, slug, taxonomy, wptt.term_id
		FROM wp_term_relationships AS wptr
		INNER JOIN wp_terms AS wpt
		ON wpt.term_id = wptr.term_taxonomy_id
		INNER JOIN wp_term_taxonomy AS wptt
		ON wptt.term_taxonomy_id = wptr.term_taxonomy_id
		WHERE wptr.object_id = $post_page_id
SQL;

		return $wpdb->get_results( $sql, ARRAY_A );
	}
}

