<?php if ($mod==""){
	header('location:../../404.php');
}else{
?>
<!-- 
*******************************************************
	Include Header Template
******************************************************* 
-->
<?php include_once "po-content/$folder/header.php"; ?>

<!-- 
*******************************************************
	Main Content Template
******************************************************* 
-->
        <div class="page">
            <div class="page_layout clearfix">
                <div class="row page_margin_top">
                    <div class="column column_2_3">
                        <ul class="small_slider">
                        <?php
                            $tableslider = new PoTable('post');
                            $sliders = $tableslider->findAllLimitByAnd(id_post, active, headline, 'Y', 'Y', DESC, '3');
                            foreach($sliders as $slider){
                                $tablecatsl = new PoTable('category');
                                $currentCatsl = $tablecatsl->findBy(id_category, $slider->id_category);
                                $currentCatsl = $currentCatsl->current();
                        ?>
                            <li class="slide">
                                <a href="<?php echo "$website_url/detailpost/$slider->seotitle"; ?>" title="<?=$slider->title;?>">
                                    <img src="<?=$website_url;?>/po-content/po-upload/<?=$slider->picture;?>" alt="<?=$slider->title;?>">
                                </a>
                                <div class="slider_content_box">
                                    <ul class="post_details simple">
                                        <li class="category"><a href="<?php echo "$website_url/category/$currentCatsl->seotitle"; ?>" title="<?=$currentCatsl->title;?>"><?=$currentCatsl->title;?></a></li>
                                        <li class="date"><?=tgl_indo($slider->date);?></li>
                                    </ul>
                                    <h2><a href="<?php echo "$website_url/detailpost/$slider->seotitle"; ?>" title="<?=$slider->title;?>"><?=cuthighlight('title', $slider->title, '35');?>...</a></h2>
                                    <p class="clearfix"><?=cuthighlight('post', $slider->content, '100');?>...</p>
                                </div>
                            </li>
                        <?php } ?>
                        </ul>
                        <!--<div class="slider_posts_list_container"></div>-->

                        

                        

                        
                    </div>
                </div>

                <div class="row page_margin_top_section">
                    <div class="column column_1_1">
                        
                        <div class="horizontal_carousel_container page_margin_top">
                            <ul class="blog horizontal_carousel page_margin_top autoplay-0 visible-4 scroll-1 navigation-1 easing-easeInOutQuint duration-750">
                            <?php
                                $nogal = 1;
                                $tablegallery = new PoTable('gallery');
                                $gallerys = $tablegallery->findAllLimit(id_gallery, DESC, '8');
                                foreach($gallerys as $gallery){
                                    $idalb = $gallery->id_album;
                                    $tablecalb = new PoTable('album');
                                    $currentCalb = $tablecalb->findBy(id_album, $idalb);
                                    $currentCalb = $currentCalb->current();
                                    if ($currentCalb->active == 'Y'){
                            ?>
                                <li class="post" style="width:188px;">
                                    <a class="post_image prettyPhoto" href="<?=$website_url;?>/po-content/po-upload/<?=$gallery->picture;?>" title="<?=$gallery->title;?>">
                                        <img src="<?=$website_url;?>/po-content/po-upload/medium/medium_<?=$gallery->picture;?>" alt="<?=$gallery->title;?>" class="img-circle">
                                    </a>
                                    <h5><span class="number"><?=$nogal;?>.</span><a class="post_image prettyPhoto" href="<?=$website_url;?>/po-content/po-upload/<?=$gallery->picture;?>" title="<?=$gallery->title;?>"><?=$gallery->title;?></a></h5>
                                    <ul class="post_details simple">
                                        <li class="category"><a href="javascript:void(0);" title="<?=$currentCalb->title;?>"><?=$currentCalb->title;?></a></li>
                                    </ul>
                                </li>
                            <?php
                                    }
                                    $nogal++;
                                } 
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- 
*******************************************************
	Include Footer Template
******************************************************* 
-->
<?php include_once "po-content/$folder/footer.php"; ?>
<?php } ?>