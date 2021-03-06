<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title">不存在内容！</h1>
		<div class="entry-content">
			<p></p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>
<div class="recommend block grid">
        <ul class="recommend-list g-u">
            <?php $args = array(
                                'posts_per_page' => 6,
                                'post__in' => get_option('sticky_posts'),
                                'caller_get_posts' => 1
                                );
                 query_posts($args);
            ?>
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <li class="grid g-u">
						<div class="image g-u">
                            <a href="<?php the_permalink() ?>" title="点此前往<?php the_title(); ?>">
                                <?php
                                if(has_post_thumbnail()) {
                                    the_post_thumbnail(array(96,44));
                                }
                                ?>
                            </a>
                        </div>
						<div class="item-detail g-u">
							<h1><a class="title entry-title" role="title" href="<?php the_permalink(); ?>" title="点此前往<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a> </h1>                    
							<footer class="info"><a href="#"><?php comments_popup_link(__('沙发还空着，抢！', 'kubrick'), __('只剩下板凳啦！', 'kubrick'), __('前<b>%</b>个座位已被强势霸占！', 'kubrick'), '', __('关闭评论', 'kubrick') ); ?>
								<?php if(function_exists('the_views')) { the_views(); } ?>
							</footer>
						</div>                      
                    </li>
                <?php endwhile; ?>
            <?php endif; wp_reset_query();?>
        </ul>

        <s class="tag tag-recommend">推荐</s>
</div>
<?php query_posts(array("post__not_in" =>get_option("sticky_posts"),'paged'=>$paged));?>
<?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class("post-digest block"); ?>>
        <h1 class="J_Post_Title"><a class="title entry-title" role="title" href="<?php the_permalink(); ?>" title="点此前往<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a> </h1>
        <div class="bd grid entry-content">
            <?php if (has_post_thumbnail()): ?>
            <p class="image g-u">
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail(); ?>
                </a>
            </p>
            <?php endif;?>
            <div class="digest g-u <?php if (!has_post_thumbnail()){echo 'no-has-thumbnail';} ?>"><?php the_excerpt();?></div>
        </div>
        
        <footer>
            <div class="author J_Author" data-email="<?php echo get_the_author_meta('user_email'); ?>">
                <figure>
                    <?php echo get_avatar( get_the_author_meta('user_email'), '70' ); ?>
                    <figcaption><b><?php the_author_posts_link();?></b></figcaption>
                </figure>
            </div>
            <p class="info">发布于<time datetime="<?php the_time(); ?>"><b><?php the_time('Y') ?>年<?php the_time('m') ?>月<?php the_time('j') ?>日</b></time>，归属于<b><?php the_category(' ,'); ?></b>。
                <?php comments_popup_link(__('沙发还空着，抢！', 'kubrick'), __('只剩下板凳啦！', 'kubrick'), __('前<b>%</b>个座位已被强势霸占！', 'kubrick'), '', __('关闭评论', 'kubrick') ); ?>
                <?php if(function_exists('the_views')) { the_views(); } ?>
            </p>
<!--            <s class="tag tag-today">今日</s>-->
            <s data-id="<?php the_ID(); ?>" class="tag tag-already-read J_AlreadyRead">已阅</s>
        </footer>
    </article>
<?php endwhile; ?>
<div class="paginator block grid">
    <div class="g-u">
        <?php if(function_exists('wp_pagenavi')) {wp_pagenavi();} ?>
    </div>
</div>