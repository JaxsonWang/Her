<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="Cache-Control" content="no-transform"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	$description = '';
	$keywords    = '';

	if ( is_home() || is_page() ) {
		// 将以下引号中的内容改成你的主页description
		$description = "";

		// 将以下引号中的内容改成你的主页keywords
		$keywords = "";
	} elseif ( is_single() ) {

		$description = get_post_meta( $post->ID, "description", true );

		// 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
		$keywords = get_post_meta( $post->ID, "keywords", true );
		if ( $keywords == '' ) {
			$tags = wp_get_post_tags( $post->ID );
			foreach ( $tags as $tag ) {
				$keywords = $keywords . $tag->name . ",";
			}
			$keywords = rtrim( $keywords, ',' );
		}
	} elseif ( is_category() ) {
		// 分类的description可以到后台 - 文章 -分类目录，修改分类的描述
		$description = category_description();
		$keywords    = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		// 标签的description可以到后台 - 文章 - 标签，修改标签的描述
		$description = tag_description();
		$keywords    = single_tag_title( '', false );
	}
	$description = trim( strip_tags( $description ) );
	$keywords    = trim( strip_tags( $keywords ) );
	?>
    <meta name="description" content="<?php echo $description; ?>"/>
    <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <title><?php wp_title( '-', true, 'right' ); ?><?php bloginfo( 'name' ); ?><?php if ( is_home() ) { ?> - <?php bloginfo( 'description' ); ?><?php } ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed"
              href="<?php bloginfo( 'rss2_url' ); ?>"/>
        <link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?> Atom Feed"
              href="<?php bloginfo( 'atom_url' ); ?>"/>
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<div id="top-bar">
    <div class="container">
        <div id="nav-wrapper">
			<?php wp_nav_menu( array( 'container'  => false, 'theme_location' => 'main-menu', 'menu_class' => 'menu'
			) ); ?>
        </div>
        <div class="menu-mobile"></div>
		<?php if ( ! get_theme_mod( 'sp_topbar_search_check' ) ) : ?>


            <div id="top-search">
				<?php get_search_form(); ?>
                <i class="iconfont icon-sousuo-sousuo search-desktop"></i>
                <i class="iconfont icon-sousuo-sousuo search-toggle"></i>
            </div>


            <!-- Responsive Search -->
            <div class="show-search">
				<?php get_search_form(); ?>
            </div>
            <!-- -->
		<?php endif; ?>

		<?php if ( ! get_theme_mod( 'sp_topbar_social_check' ) ) : ?>
		<?php endif; ?>
    </div>

</div>


<?php if ( is_singular() ) { ?>
    <header id="header" class="alt" style="background-image:url(
	<?php if ( has_post_thumbnail() ) : ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-thumb' );
		echo $image[0]; ?>
	<?php else : ?>
		<?php
		if ( get_option( 'def_banner' ) == '' ) {
			echo get_template_directory_uri() . '/img/banner.jpg';
		} else {
			echo get_option( "def_banner" );
		}
		?>
	<?php endif; ?>
            );">
        <div class="inner">
            <h1 class="post-page-title "><?php the_title(); ?></h1>
            <p><?php echo sp_string_limit_words( get_the_excerpt(), 8 ); ?></p>
            <p><?php the_time( get_option( 'date_format' ) ); ?> · <?php echo fa_get_post_readtime(); ?>分钟</p>
        </div>
    </header><!-- .site-header -->
<?php } ?>


<div id="content" class="site-content">

