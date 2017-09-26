<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="container">
				<div class="row tier2">
					<div class="col-md">
						<p>Running ads is hard and time consuming.</p>
						Between:
			<ul>
				<li>Learning to run ads</li>
				<li>Writing ad copy</li>
				<li>Managing campaigns</li>
				<li>Moderating comments</li>
			</ul>
						<span>Now There&rsquo;s A Better Way</span>
					</div>
					<div class="col-md">
						<p>Marketing your business can get really
						expensive</p>
						<p><b>Funnlz can help reduce your marketing budget for your ads by as much as 50%</b></p>
						<div class="btn-pos text-center"><button class="btn btn-secondary my-2 my-sm-0" role="button" type="button">LEARN MORE</button></div>
					</div>
					<div class="col-md">
						Getting customers to convert to sales has never been  easier. With Funnelz unique co-operative marketing platform your products receive more exposure for less money, leading to more sales.
					</div>
				</div>
				<row>
					<div class="col text-center">
						<h2>A MUCH NEEDED
							TITLE FOR THIS AREA</h2>
					</div>
				</row>
				<div class="row tier3 tier3-type1">
					<div class="col-6 col-lg-3">
						<div class="spotimg spot5"></div>
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="overlay">
							<div class="text">More descriptive text</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="spotimg spot6"></div>
						<div class="overlay">
							<div class="text">More descriptive text 2 More descriptive text 2</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div class="spotimg spot7"></div>
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="overlay">
							<div class="text">More descriptive text</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="spotimg spot8"></div>
						<div class="overlay">
							<div class="text">More descriptive text 2 More descriptive text 2</div>
						</div>
					</div>
				</div>
				<div class="row tier3 tier3-type2">
					<div class="col-6 col-lg-3">
						<div class="spotimg spot9"></div>
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="overlay">
							<div class="text">More descriptive text</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="spotimg spot7"></div>
						<div class="overlay">
							<div class="text">More descriptive text 2 More descriptive text 2</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div class="spotimg spot5"></div>
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="overlay">
							<div class="text">More descriptive text</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="spotimg spot6"></div>
						<div class="overlay">
							<div class="text">More descriptive text 2 More descriptive text 2</div>
						</div>
					</div>
				</div>
				<div class="row tier3 tier3-type1">
					<div class="col-6 col-lg-3">
						<div class="spotimg spot8"></div>
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="overlay">
							<div class="text">More descriptive text</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="spotimg spot6"></div>
						<div class="overlay">
							<div class="text">More descriptive text 2 More descriptive text 2</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div class="spotimg spot9"></div>
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="overlay">
							<div class="text">More descriptive text</div>
						</div>
					</div>
					<div class="col-6 col-lg-3">
						<div>Running ads is hard and time consuming. Between: Learning to run ads Writing ad copy Managing campaigns Moderating comments Now There’s A Better Way</div>
						<div class="spotimg spot7"></div>
						<div class="overlay">
							<div class="text">More descriptive text 2 More descriptive text 2</div>
						</div>
					</div>
				</div>
			</div>

			
		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>

			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

		</article>
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
