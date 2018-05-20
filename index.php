<?php get_header(); ?>
	<?php if(have_posts()) : ?>
		<div class = "page-title"><h1><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h1></div>
			<?php while(have_posts()) : the_post();
			if(has_category('blog')) : ?>
			
			<article class ="postBlog">	
				<?php if(has_post_thumbnail()):?>
					<div class="postThumb"><?php the_post_thumbnail('thumbnail');?></div>
				<?php endif; ?>
				<a href="<?php the_permalink()?>"><h3><?php the_title(); ?></h3></a>
				<small><?php edit_post_link() ?></small>
				<?php the_content(); ?>
				<hr>
				<div class="flexPost">
					<p class="postTime">Posted on <?php the_time('F j, Y') ?></p>
					<div class="openPost" id="<?php the_ID() ?>"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
				</div>
				<aside class="postCollapse" id="post_<?php the_ID() ?>" style = "height:4em;">
					<div id ="content_<?php the_ID() ?>" class="hideContent">
						<?php
							global $withcomments;
							$withcomments = 1;
							comments_template('/comments.php', true); ?>
					</div>
					</aside>
			</article>

<?php endif;
																
																
			if(has_category('publications')) : ?>
			<article class ="postPub">	
				<?php if(has_post_thumbnail()):?>
					<div class="postThumb"><?php the_post_thumbnail('thumbnail');?></div>
				<?php endif; ?>
				<a href="<?php the_permalink()?>"><cite><?php the_title(); ?></cite></a>
				<cite class="pubDetails"><?php the_secondary_title(); ?></cite>
				<small><?php edit_post_link() ?></small>
				<div class="flexPost">
					<p class="postTime">Published on <?php the_time('F j, Y') ?></p>
					<div class="openPost" id="<?php the_ID() ?>"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
				</div>
				<hr>
					<aside class="pubCollapse" id="post_<?php the_ID() ?>" style = "height:4em;">
						<div id ="content_<?php the_ID() ?>" class="hideContent">
							<?php the_content(); ?>
						</div>
				</aside>
			</article>
		<?php
			endif;
		endwhile;
	endif; ?>

<?php get_footer(); ?>