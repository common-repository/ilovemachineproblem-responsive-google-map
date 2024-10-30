<style>
	.ilmp-map-wrapper {
		width: <?php echo get_option('ilmp_width'); ?>;
	}
	#ilmp-map-canvas {
	    height: <?php echo get_option('ilmp_height'); ?>;
		width: <?php echo get_option('ilmp_width'); ?>;
	}
	#ilmp-map-canvas h1 {
		  margin-top: 0;
	}

	#ilmp-content {
		width: <?php echo get_option('ilmp_infow'); ?>;
		height: <?php echo get_option('ilmp_infoh'); ?>;
	}

	@media only screen and ( max-width: <?php echo get_option('ilmp_resp'); ?> ) {
	   .ilmp-map-wrapper {
			margin: auto;
			width: 90%;
	   }
	   #ilmp-map-canvas {
	   		width: 100%;
	   }
	}
</style>