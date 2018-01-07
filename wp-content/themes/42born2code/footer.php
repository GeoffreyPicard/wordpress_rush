	</div>
</div><!-- #container -->
<div id="footer">
	<div class="pads">
		<ul id="menu-bottom" class="clearfix">
			<div class="footer_sidebar">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("footer-sidebar-1") ) : ?>
				<?php endif; ?>
			</div>
			<!-- #ici code -->
		</ul>
	</div>
	<div class="footerlinks">
<!-- #ici code -->
	</div>
</div><!-- #footer -->
<?php wp_footer() ?> <!-- #NE PAS SUPPRIMER cf. codex wp_footer() -->
</body>
</html>