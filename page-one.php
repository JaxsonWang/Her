<?php

/**
 * Template Name: One 一个
 */


$url = 'http://wufazhuce.com';//one一个url
$data = get_file($url);
//数据接收完成
//准备分析数据
$title = '/(?<=(<p class="titulo">))[^<]*(?=(<\/p>))/';//匹配标题
$num_1 = preg_match_all($title, $data, $match_title);
$imgurl = '/(?<=(<img class="fp-one-imagen" src="))[^<]*(?=(" alt="" \/><\/a> ))/';//匹配图片url
$num_2 = preg_match_all($imgurl, $data, $match_imgurl);
$img_title = '/(?<=( ))[^>]*(?=(&))/';//匹配图片标题
$num_3 = preg_match_all($img_title, $data, $match_imgtitle);
$img_author = '/(?<=(&amp;))[^<]*(?=(<\/div>))/';//匹配图片作者
$num_4 = preg_match_all($img_author, $data, $match_imgauthor);
$word = '/(?<=(<a href="http:\/\/wufazhuce.com\/one\/)\d{4}">)[^>]*(?=(<))/';//匹配文字
$num_5 = preg_match_all($word, $data, $match_word);
//数据分析完成
//准备处理数据
//echo "function onetitle(){document.write(\"" . $match_title[0][0] . "\");}";
//echo "function oneimga(){document.write(\"" . $match_imgtitle[0][0] . '<br>' . $match_imgauthor[0][0] . "\");}";
//echo "function oneword(){document.write(\"" . $match_word[0][1] . "\");}";


//数据处理完成
function get_file($url)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$data = curl_exec($curl);
	curl_close($curl);
	return $data;
}

//对接成功

?>
<?php get_header(); ?>
<section id="primary" class="content-area">
    <main class="full-page">
        <div class="full-content">
            <div>
		        <?php
		        // Start the loop.
		        while ( have_posts() ) : the_post();
			        // Include the page content template.
			        get_template_part( 'inc/content-single', 'page' );
			        // End of the loop.
		        endwhile;
		        ?>
            </div>
            <div class="akina_one">
                <div class="akina_one_image">
                    <img src="<?php echo get_stylesheet_directory_uri() .'/layouts/one/img.php'; ?>" alt="One一个绘图"/>
                </div><!--One图片-->
                <div class="akina_one_main">
                    <div class="akina_one_text">
                        <div class="akina_one_title"><?php echo $match_title[0][0] ?></div>

                        <div class="akina_one_content"><?php echo $match_word[0][1] ?></div>
                    </div>
                    <div class="akina_one_time">
                        <div class="date"><?php echo date('d');?></div>
                        <div class="year"><span><?php echo date('M',get_the_time('U'));?></span><?php echo date('Y');?></div>
                    </div><!--日期-->
                </div><!--One一句-->
            </div>
        </div>
    </main>
</section>

<?php get_footer(); ?>
