<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name() {
	// Change this to use your theme slug
	$option_name = get_option( 'stylesheet' );
    $option_name = preg_replace( "/\W/", "_", strtolower( $option_name ) );
    return $option_name;
}

/** 
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'ui_boxmoe_com'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __( 'One', 'ui_boxmoe_com' ),
		'two' => __( 'Two', 'ui_boxmoe_com' ),
		'three' => __( 'Three', 'ui_boxmoe_com' ),
		'four' => __( 'Four', 'ui_boxmoe_com' ),
		'five' => __( 'Five', 'ui_boxmoe_com' )
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __( 'French Toast', 'ui_boxmoe_com' ),
		'two' => __( 'Pancake', 'ui_boxmoe_com' ),
		'three' => __( 'Omelette', 'ui_boxmoe_com' ),
		'four' => __( 'Crepe', 'ui_boxmoe_com' ),
		'five' => __( 'Waffle', 'ui_boxmoe_com' )
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = '??????????????????:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/assets/images/';
	$webhome = 'http://www.boxmoe.com';
	$options = array();
//==========================================================================================
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'desc' => __( '???LOGO Favicon ????????????????????????????????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __( '???1???LOGO??????', 'ui_boxmoe_com' ),
		'id' => 'logo_src',
		'desc' => __(' ', 'ui_boxmoe_com'),
		'std' => $imagepath.'logo.png',
		'type' => 'upload');
	$options[] = array(
		'name' => __( '???2???Favicon??????', 'ui_boxmoe_com' ),
		'id' => 'favicon_src',
		'std' => $imagepath.'favicon.ico',
		'type' => 'upload');	
	$options[] = array(
		'name' => __('???3?????????????????????????????????CSS JS', 'ui_boxmoe_com'),
		'instructions' => __('??????????????????????????????????????????????????????[assets??????????????????]???', 'ui_boxmoe_com'),
		'id' => 'style_src_onoff',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);		
	$options[] = array(
	    'name' => __('???3-1??????????????????assets???????????????????????? OSS?????????????????????????????????????????????/', 'ui_boxmoe_com'), 
		'id' => 'style_src',
		'std' => '',
		'settings' => array('rows' => 2),
		'class' => 'hidden',
		'type' => 'textarea');	
	$gravatar_array = array(
	    'lolinet' => __('????????????????????????', 'ui_boxmoe_com'),
		'qiniu' => __('????????????????????????', 'ui_boxmoe_com'),
		'geekzu' => __('????????????????????????', 'ui_boxmoe_com'),
		'v2excom' => __('v2ex?????????', 'ui_boxmoe_com'),
		'cn' => __('??????CN?????????', 'ui_boxmoe_com'),
		'ssl' => __('??????SSL?????????', 'ui_boxmoe_com'),		
	);
	$options[] = array(
		'name' => __('???4???Gravatar?????????????????????', 'ui_boxmoe_com'),
		'instructions' => __('??????????????????????????????gravatar?????????????????????', 'ui_boxmoe_com'),
		'id' => 'gravatar_url',
		'std' => 'lolinet',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $gravatar_array);	
	$options[] = array(
		'name' => __('???5?????????????????????category??????', 'ui_boxmoe_com'),
		'instructions' => __('????????????????????????/?????????????????????????????? wordpress????????? ??? ???????????????', 'ui_boxmoe_com'),
		'id' => 'no_categoty',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);	
    $options[] = array(
		'name' => __('???6???????????????????????????', 'ui_boxmoe_com'),
		'id' => 'sousuo',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('??????', 'ui_boxmoe_com')); 
	$options[] = array(
		'name' => __('???7???????????????????????????????????????back to top ??????????????????', 'ui_boxmoe_com'),
		'id' => 'lolijump',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com')); 
	$options[] = array(
			'name' => __('???7-1????????????????????????', 'ui_boxmoe_com'),
			'id' => 'lolijumptext',
			'std' => '????????????',
			'class' => 'hidden mini',
			'instructions' => __('?????????????????????????????????????????????????????????', 'ui_boxmoe_com'),
			'type' => 'text');		
	$options[] = array(
		'name' => __('???7-2????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'lolijumpsister',
		'type' => "radio",
		'std' => 'lolisister1',
		'class' => 'hidden',
		'options' => array(
			'lolisister1' => __(' ???????????? ', 'ui_boxmoe_com'),
			'lolisister2' => __(' ????????????', 'ui_boxmoe_com'),
			'meow' => __(' ?????????', 'ui_boxmoe_com'),
			'bear' => __(' ?????????', 'ui_boxmoe_com')
		));			
	$hitokoto_array = array(
	    'a' => __('??????', 'ui_boxmoe_com'),
		'b' => __('??????', 'ui_boxmoe_com'),
		'c' => __('??????', 'ui_boxmoe_com'),
		'd' => __('??????', 'ui_boxmoe_com'),
		'e' => __('??????', 'ui_boxmoe_com'),
		'f' => __('????????????', 'ui_boxmoe_com'),	
		'g' => __('??????', 'ui_boxmoe_com'),
		'h' => __('??????', 'ui_boxmoe_com'),
		'i' => __('??????', 'ui_boxmoe_com'),
		'j' => __('?????????', 'ui_boxmoe_com'),
		'k' => __('??????', 'ui_boxmoe_com'),
	);
	$options[] = array(
		'name' => __('???8???????????????????????????', 'ui_boxmoe_com'),
		'instructions' => __('??????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'hitokoto_text',
		'std' => 'lolinet',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $hitokoto_array);	

	$options[] = array(
		'name' => __('???9???????????????????????????', 'ui_boxmoe_com'),
		'id' => 'footer_seo',
		'std' => '<ul class="nav nav-footer justify-content-center mt10"><li class="nav-item"><a href="'.site_url('/sitemap.xml').'" class="nav-link" target="_blank">'.__('????????????', 'ui_boxmoe_com').'</a></li></ul>'."\n",
		'instructions' => __('??????????????????????????????sitemap?????????????????????', 'ui_boxmoe_com'),
		'settings' => array('rows' => 3),
		'type' => 'textarea');
	$options[] = array(
		'name' => __('???10???????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'footer_info',
		'std' => '| ????????????Wordpress??????'."\n",
		'settings' => array('rows' => 3),
		'type' => 'textarea');	
	$options[] = array(
		'name' => __('???11?????????????????????????????????', 'ui_boxmoe_com'),
		'instructions' => __('????????????????????????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'boxmoedataquery',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'));	
    $options[] = array(
		'name' => __('???12???????????????', 'ui_boxmoe_com'),
		'instructions' => __('??????????????????????????????????????????,????????????????????????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'trackcode',
		'std' => '????????????',
		'settings' => array('rows' => 3),
		'type' => 'textarea');		
	$options[] = array(

		'id' => 'trackcodehidden',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('?????????????????????????????????????????????????????????????????????????????????????????????', 'ui_boxmoe_com'));
	$options[] = array(
		'name' => __('???7-1????????????????????????'),
		'instructions' => __('?????????????????????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'lolijump_font',
		'std' => 'https://boxmoe.com',
		'class' => 'hidden',
		'type' => 'text');	


//==========================================================================================
	$options[] = array(
		'name' => __( 'Banner??????', 'ui_boxmoe_com' ),
		'desc' => __( '??????????????????????????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __('??????Banner?????????', 'ui_boxmoe_com'),
		'id' => 'banner_url',
		'std' => $imagepath.'banner/1.jpg',
		'type' => 'upload');    
    $options[] = array(
		'name' => __('Banner???????????????', 'ui_boxmoe_com'),
		'instructions' => __('?????????????????????????????????????????????boxmoe/assets/images/banner/????????????????????????', 'ui_boxmoe_com'),		
		'id' => 'banner_rand',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);	 
	$options[] = array(
		'name' => __('Banner??????????????????', 'ui_boxmoe_com'),
		'id' => 'banner_rand_n',
		'std' => 12,
		'instructions' => __('??????????????????1.jpg ...x.jpg ???x=1-?????????????????????????????????JPG??? ', 'ui_boxmoe_com'),
		'class' => 'hidden mini',
		'type' => 'text');	
//==========================================================================================
	$options[] = array(
		'name' => __( 'SEO??????', 'ui_boxmoe_com' ),
		'desc' => __( '????????????????????????SEO?????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);	
    $options[] = array(
		'name' => __( '?????????????????????', 'ui_boxmoe_com' ),
		'instructions' => __('??????-?????????_????????????????????????????????????????????????SEO???', 'ui_boxmoe_com'),
		'id' => 'connector',
		'std' => get_boxmoe('connector') ? get_boxmoe('connector') : '-',
		'class' => 'mini',
		'type' => 'text');

	$options[] = array(
		'name' => __('??????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'baidutuisong',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com')); 
	 
	$options[] = array(
		'name' => __( '??????????????????????????????key', 'ui_boxmoe_com' ),
		'id' => 'baidutuisongkey',
		'std' =>'',
		'type' => 'text',
		'class' => 'hidden',
		'desc' => __('???????????????????????????????????????????????????Baidusubmit?????????1', 'ui_boxmoe_com'),
	);	 
	 
	$options[] = array(
		'name' => __('???????????????(keywords)', 'ui_boxmoe_com'),
		'id' => 'keywords',
		'std' => 'WordPress',
		'desc' => __('?????????????????????', 'ui_boxmoe_com'),
		'settings' => array(
			'rows' => 3
		),
		'type' => 'textarea');

	$options[] = array(
		'name' => __('????????????(description)', 'ui_boxmoe_com'),
		'id' => 'description',
		'std' => '??????????????????',
		'settings' => array(
		'rows' => 3),
		'type' => 'textarea');

	$options[] = array(
		'name' => __('???????????????', 'ui_boxmoe_com'),
		'instructions' => __('??????????????????????????????????????????????????????????????????????????????????????????????????????::::::???6????????????????????????????????????????????????????????????1,?????????2::::::???????????????', 'ui_boxmoe_com'),
		'id' => 'cat_keyworks_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com')
		);

	$options[] = array(
		'name' => __('????????????????????????????????????', 'ui_boxmoe_com'),
		'instructions' => __('???????????????????????????????????????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'site_keywords_description_s',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('??????', 'ui_boxmoe_com'));

	$options[] = array(
		'name' => __('?????????????????????????????????', 'ui_boxmoe_com'),
		'instructions' => __('??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'post_keywords_description_s',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'));	
//==========================================================================================
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'desc' => __( '????????????????????????????????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __('????????????????????????', 'ui_boxmoe_com'),
		'id' => 'comments_off',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'));
	$options[] = array(
		'name' => __('??????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'blog_list_style',
		'std' => "list_style_1",
		'type' => "radio",
		'options' => array(
			'list_style_1' => __('????????????', 'ui_boxmoe_com'),
			'list_style_2' => __('????????????', 'ui_boxmoe_com'),
			'list_style_3' => __('????????????', 'ui_boxmoe_com')
		));	
	$options[] = array(
		'name' => __('?????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'blog_border',
		'std' => "border1",
		'type' => "radio",
		'options' => array(
			'border1' => __('????????????', 'ui_boxmoe_com'),
			'border2' => __('????????????', 'ui_boxmoe_com')
		));
	$options[] = array(
		'name' => __('????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'wow_on',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'));		
	$options[] = array(
		'name' => __('???????????????????????????', 'ui_boxmoe_com'),
		'id' => 'thumbnail_rand_n',
		'std' => 5,
		'class' => 'mini',
		'instructions' => __('????????????????????????boxmoe/assets/images/rand/N.jpg???N=1-?????????????????????', 'ui_boxmoe_com'),
		'type' => 'text');	
	$options[] = array(
		'name' => __('??????????????????', 'ui_boxmoe_com'),
		'instructions' => __('??????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'code_light_on',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'));		
    $options[] = array(
		'name' => __('?????????????????????', 'ui_boxmoe_com'),
		'instructions' => __('????????????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'target_blank',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'));	
	$options[] = array(
		'name' => __('????????????????????????', 'ui_boxmoe_com'),
		'id' => 'paging_type',
		'std' => "multi",
		'type' => "radio",
		'options' => array(
			'next' => __(' ????????? ??? ?????????', 'ui_boxmoe_com'),
			'multi' => __('??????  1 2 3 ', 'ui_boxmoe_com')
		));
	//$options[] = array(
	//	'name' => __('????????????????????????', 'ui_boxmoe_com'),
	//	'id' => 'post_related_s',
	//	'type' => "checkbox",
	//	'std' => true,
	//	'desc' => __('??????', 'ui_boxmoe_com'));
    //$options[] = array(
	//	'name' => __('????????????????????????', 'ui_boxmoe_com'),
	//	'id' => 'post_related_model',
	//	'type' => "radio",
	//	'std' => 'thumb',
	//	'options' => array(
	//		'thumb' => __(' ???????????? ', 'ui_boxmoe_com'),
	//		'text' => __(' ??????????????? ', 'ui_boxmoe_com')
	//	));
	//$options[] = array(
	//	'name' => __('????????????-??????????????????', 'ui_boxmoe_com'),
	//	'id' => 'post_related_n',
	//	'std' => 3,
	//	'class' => 'mini',
	//	'desc' => __('????????????3 6 9 12????????????', 'ui_boxmoe_com'),
	//	'type' => 'text');		
	$options[] = array(
		'name' => __('?????????????????????', 'ui_boxmoe_com'),
		'instructions' => __('??????????????????????????????', 'ui_boxmoe_com'),		
		'id' => 'open_author_info',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'));	
	$options[] = array(
		'name' => __('??????????????????', 'ui_boxmoe_com'),
		'instructions' => __('?????????????????????????????????????????????????????????', 'ui_boxmoe_com'),	
		'id' => 'authorinfo',
		'settings' => array(
		'rows' => 3),
		'class' => 'hidden',
		'std' => '??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????...',
		'type' => 'textarea');		
//==========================================================================================
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __('????????????????????????????????????????????????', 'ui_boxmoe_com'),	
		'id' => 'false_enjp_comment',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'));	
	$options[] = array(
			'name' => __('??????:?????????????????????', 'ui_boxmoe_com'),
			'id' => 'comnanes',
			'std' => '??????',
			'class' => 'mini',
			'desc' => __('????????????????????????????????????', 'ui_boxmoe_com'),
			'type' => 'text');
    $options[] = array(
			'name' => __('??????:????????????????????????', 'ui_boxmoe_com'),
			'id' => 'comnanesu',
			'std' => '??????',
			'class' => 'mini',
			'desc' => __('???????????????????????????????????????', 'ui_boxmoe_com'),
			'type' => 'text');
	$options[] = array(
			'name' => __('??????:??????????????????', 'ui_boxmoe_com'),
			'id' => 'comnaness',
			'std' => '??????',
			'class' => 'mini',
			'desc' => __('????????????????????????????????????', 'ui_boxmoe_com'),
			'type' => 'text');		
//==========================================================================================
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'desc' => __( '?????????????????????????????????erphpdown???????????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);	
	$options[] = array(
		'name' => __('??????????????????????????????', 'ui_boxmoe_com'),
		'instructions' => __( '???????????????erphpdown?????????', 'ui_boxmoe_com' ),
		'id' => 'sign_f',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com')
	);
	//$options[] = array(
	//	'name' => __( '????????????????????????', 'ui_boxmoe_com' ),
	//	'instructions' => __( '??????????????????????????????', 'ui_boxmoe_com' ),
	//	'id' => 'reg_question',
	//	'type' => 'text',
	//	'class' => 'hidden mini',
	//	'std' => ''
	//);
	$options[] = array(
		'name' => __( '????????????????????????Banner???', 'ui_boxmoe_com' ),
		'id' => 'user_banner_src',
		'desc' => __(' ', 'ui_boxmoe_com'),
		'std' => $imagepath.'banner/1.jpg',
		'type' => 'upload');
    $options[] = array(
		'name' => __('????????????????????????', 'ui_boxmoe_com'),
		'id' => 'sign_zhcn',
		'type' => "checkbox",
		'std' => false,
		'class' => 'hidden',
		'desc' => __('??????', 'ui_boxmoe_com')
	);
	$options[] = array(
		'name' => __( '??????????????????', 'ui_boxmoe_com' ),
		'desc' => __( '???????????????????????????????????????????????????????????????????????????', 'ui_boxmoe_com' ),
		'id' => 'users_login',
		'type' => 'select',
		'class' => 'hidden',
		'options' => $options_pages
	);
	$options[] = array(
		'name' => __( '??????????????????', 'ui_boxmoe_com' ),
		'desc' => __( '???????????????????????????????????????????????????????????????????????????', 'ui_boxmoe_com' ),
		'id' => 'users_reg',
		'type' => 'select',
		'class' => 'hidden',
		'options' => $options_pages
	);
	$options[] = array(
		'name' => __( '??????????????????', 'ui_boxmoe_com' ),
		'desc' => __( '??????????????????????????????????????????????????????????????????????????????????????????erphpdown?????????', 'ui_boxmoe_com' ),
		'id' => 'users_page',
		'type' => 'select',
		'class' => 'hidden',
		'options' => $options_pages
	);	
    $options[] = array(
		'name' => __( '?????????????????????????????????', 'ui_boxmoe_com' ),
		'id' => 'regto',
		'std' => $webhome,
		'class' => 'hidden',
		'type' => 'text'
	);	
    $options[] = array(
		'name' => __( '?????????????????????????????????', 'ui_boxmoe_com' ),
		'id' => 'loginto',
		'std' => $webhome,
		'class' => 'hidden',
		'type' => 'text'
	);	
//==========================================================================================
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);	
	//$options[] = array(
	//	'name' => __('?????????????????????'),
	//	'instructions' => __('???????????????????????????????????????????????????????????????', 'ui_boxmoe_com'),
	//	'id' => 'boxmoe_dayegivemesomemoney',
	//	'std' => $imagepath.'dayegivemesomemoney.jpg',
	//	'type' => 'upload');
	$options[] = array(
		'name' => __('QQ??????'),
		'instructions' => __('????????????QQ?????????????????????', 'ui_boxmoe_com'),
		'id' => 'boxmoe_qq',
		'std' => '10000',
		'class' => 'mini',
		'type' => 'text');	
	$options[] = array(
		'name' => __('???????????????'),
		'instructions' => __('???????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'boxmoe_wechat',
		'std' => $imagepath.'wechat.jpg',
		'type' => 'upload');		
    $options[] = array(
		'name' => __('Email??????'),
		'instructions' => __('???????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'boxmoe_mail',
		'class' => 'mini',
		'type' => 'text');	
	$options[] = array(
		'name' => __('Github'),
		'instructions' => __('????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'boxmoe_github',
		'std' => 'https://www.boxmoe.com',
		'type' => 'text');
    $options[] = array(
		'name' => __('??????'),
		'instructions' => __('????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'boxmoe_weibo',
		'std' => 'https://www.boxmoe.com',
		'type' => 'text');
//==========================================================================================
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);	
	$options[] = array(
		'name' => __('??????????????????', 'ui_boxmoe_com'),
		'id' => 'indexlinks',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);
	$options[] = array(
		'name' => __('??????????????????????????????'),
		'desc' => __('?????????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'yqlinks',
		'std' => 'https://boxmoe.com',
		'type' => 'text');	
	$options[] = array(
		'name' => __('????????????????????????'),
		'desc' => __('??????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'yqlinksname',
		'std' => '????????????',
		'type' => 'text');
	$options[] = array(
		'name' => __('????????????????????????ID'),
		'desc' => __('????????????????????????????????????id?????????????????????', 'ui_boxmoe_com'),
		'id' => 'yqlinksid',
		'class' => 'mini',
		'std' => 'null',
		'type' => 'text');		
//==========================================================================================
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'type' => 'heading'
	);
	$options[] = array(
		'name' => __('??????SMTP????????????', 'ui_boxmoe_com'),
		'instructions' => __('?????????????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'smtpmail',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);	
	$options[] = array(
		'name' => __( '?????????', 'ui_boxmoe_com' ),
		'id' => 'fromnames',
		'std' => '?????????',
		'class' => 'mini hidden',
		'type' => 'text'
	);		
	$options[] = array(
		'name' => __( 'SMTP?????????', 'ui_boxmoe_com' ),
		'id' => 'smtphost',
		'std' => 'smtp.boxmoe.com',
		'class' => 'mini hidden',
		'type' => 'text'
	);
    $options[] = array(
		'name' => __( '??????SSL?????????????????????????????????25', 'ui_boxmoe_com' ),
		'id' => 'smtpsecure',
		'std' => 'ssl',
		'class' => 'mini hidden',
		'type' => 'text'
	);		
    $options[] = array(
		'name' => __( 'SMTP??????(SSL?????????465????????????25)', 'ui_boxmoe_com' ),
		'id' => 'smtpprot',
		'std' => '465',
		'class' => 'mini hidden',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'id' => 'smtpusername',
		'std' => 'sys@boxmoe.com',
		'class' => 'mini hidden',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => __( '????????????', 'ui_boxmoe_com' ),
		'id' => 'smtppassword',
		'std' => 'boxmoe',
		'class' => 'mini hidden',
		'type' => 'password'
	);
 
//==========================================================================================
	$options[] = array(
		'name' => __('????????????', 'ui_boxmoe_com'),
		'type' => 'heading');
	$options[] = array(
		'name' => __('???????????????????????????????????????', 'ui_boxmoe_com'),
		'id' => 'gutenberg_off',
		'type' => "checkbox",
		'std' => true,
		'desc' => __('?????? ???5.0?????????????????????????????????????????????????????????', 'ui_boxmoe_com'));		 	
	$options[] = array(
		'name' => __('Wordpress????????????', 'ui_boxmoe_com'),
		'id' => 'wpheader_on',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('?????? ?????????feed WordPress?????????????????????????????????????????????????????????????????????????????????????????????', 'ui_boxmoe_com'),);	
	$options[] = array(
		'name' => __('????????????feed', 'ui_boxmoe_com'),
		'id' => 'feed_off',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);			
	$options[] = array(
		'name' => __('????????????emoji????????? dns-refresh ??????', 'ui_boxmoe_com'),
		'id' => 'remove_dns_refresh',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);	
	$options[] = array( 
		'name' => __('????????????????????????', 'ui_boxmoe_com'),
		'id' => 'autosaveop',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);
	$options[] = array(
		'name' => __('????????????????????????', 'ui_boxmoe_com'),
		'id' => 'revisions_to_keepop',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);
	$options[] = array(
		'name' => __('??????Emoji', 'ui_boxmoe_com'),
		'id' => 'emoji_off',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);		
	$options[] = array(
		'name' => __('??????RSS??????', 'ui_boxmoe_com'),
		'id' => 'rss_off',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);		
	$options[] = array(
		'name' => __('??????Pingback', 'ui_boxmoe_com'),
		'id' => 'Pingback_off',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);		
	$options[] = array(
		'name' => __('??????embeds', 'ui_boxmoe_com'),
		'id' => 'embeds_off',
		'type' => "checkbox",
		'std' => false,
		'desc' => __('??????', 'ui_boxmoe_com'),);	
	
//==========================================================================================
	$options[] = array(
		'name' => __('????????????', 'ui_boxmoe_com'),
		'desc' => __( '??????????????????????????????????????????', 'ui_boxmoe_com' ),
		'type' => 'heading');
//?????????===================================================================================







//???????????????=====================================================================================
	return $options;
}