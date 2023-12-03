<?php

/**
 * Provides ways to render views.
 * 
 * This is a hardcoded class which will render the navigation bar by
 * calling {@link @renderNavigation} static method.
 * 
 * Also provides ways o call render the partials directory , by 
 * calling {@link renderPartials } static method.
 */
class View {

	/**
	 * Static method to render the navigation bar.
	 */
	public static function renderNavigation() {
		require "./partials/navigation.php";
	}

	/**
	 * Static method to render for '/register' or '/login' routes
	 * the expected partials files.
	 */
	public static function renderPartials() {
		if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === '/register') {
			require "./partials/register.php";
		} else if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] === '/login') {
			require "./partials/login.php";
		} else {
			echo "No such url";
		}
	}
}

?>