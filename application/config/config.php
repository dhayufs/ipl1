<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| BASE URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| If you are using the index.php file name rewrite, you might have to set
| your base URL manually. For example:
|
|	$config['base_url'] = 'http://example.com/';
|
*/
$config['base_url'] = 'https://ipl1.dhayuservers.web.id/'; // Biarkan kosong jika di server, atau isi dengan URL lengkap jika tidak bisa dideteksi otomatis
$config['index_page'] = '';
$config['sess_driver'] = 'database';
$config['sess_save_path'] = 'ci_sessions';
$config['cookie_prefix'] = '';
$config['cookie_domain'] = '';
$config['cookie_path'] = '/';
$config['cookie_secure'] = FALSE;
$config['cookie_httponly'] = FALSE;
$config['uri_protocol'] = 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language'] = 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['composer_autoload'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
$config['allow_get_array'] = TRUE;
$config['log_threshold'] = 4; // Ubah ke 4 untuk debugging
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = 'your_encryption_key_here';
$config['sess_encrypt_cookie'] = FALSE;
$config['sess_use_database'] = TRUE;
$config['sess_table_name'] = 'ci_sessions';
$config['sess_expiration'] = 7200;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
$config['cookie_secure'] = FALSE;
$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();
$config['compress_output'] = FALSE;
$config['master_view_dir'] = '';
$config['use_page_numbers'] = TRUE;
$config['full_tag_open'] = '<p>';
$config['full_tag_close'] = '</p>';
$config['first_link'] = 'First';
$config['last_link'] = 'Last';
$config['first_tag_open'] = '<div>';
$config['first_tag_close'] = '</div>';
$config['last_tag_open'] = '<div>';
$config['last_tag_close'] = '</div>';
$config['next_tag_open'] = '<div>';
$config['next_tag_close'] = '</div>';
$config['prev_tag_open'] = '<div>';
$config['prev_tag_close'] = '</div>';
$config['num_tag_open'] = '<div>';
$config['num_tag_close'] = '</div>';
$config['cur_tag_open'] = '<b>';
$config['cur_tag_close'] = '</b>';