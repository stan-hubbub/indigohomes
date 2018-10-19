<?php
/**
 * Public face of Temporary Login Without Password
 *
 * @package Temporary Login Without Password
 */

/**
 * Class Wp_Temporary_Login_Without_Password_Public
 *
 * @package Temporary Login Without Password
 */
class Wp_Temporary_Login_Without_Password_Public {

	/**
	 * Plugin Name
	 *
	 * @var string $plugin_name
	 */
	private $plugin_name;

	/**
	 * Plugin Version
	 *
	 * @var string $version
	 */
	private $version;

	/**
	 * Wp_Temporary_Login_Without_Password_Public constructor.
	 *
	 * @param string $plugin_name Plugin Name.
	 * @param srting $version Plugin Version.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Get Error Message
	 *
	 * @param string $error_code Error Code.
	 *
	 * @return array|mixed|string
	 */
	public static function get_error_messages( $error_code ) {

		$error_messages = array(
			'token'  => __( 'Token empty', 'temporary-login-without-password' ),
			'unauth' => __( 'Authentication failed', 'temporary-login-without-password' ),
		);

		if ( ! empty( $error_code ) ) {
			return ( isset( $error_messages[ $error_code ] ) ? $error_messages[ $error_code ] : '' );
		}

		return $error_messages;
	}

	/**
	 * Initialize tlwp
	 *
	 * Hooked to init filter to initilize tlwp
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init_wtlwp() {

		if ( ! is_user_logged_in() && ! empty( $_GET['wtlwp_token'] ) ) { // phpcs:ignore

			$wtlwp_token = sanitize_key( $_GET['wtlwp_token'] );  // Input var okay.
			$users       = Wp_Temporary_Login_Without_Password_Common::get_valid_user_based_on_wtlwp_token( $wtlwp_token );


			if ( empty( $users ) ) {
				wp_safe_redirect( home_url() );
			} else {
				$user = $users[0];

				$user_id    = $user->ID;
				$user_login = $user->login;
				update_user_meta( $user_id, '_wtlwp_last_login', Wp_Temporary_Login_Without_Password_Common::get_current_gmt_timestamp() ); // phpcs:ignore
				wp_set_current_user( $user_id, $user_login );
				wp_set_auth_cookie( $user_id );

				$redirect_to     = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : admin_url();
				$redirect_to_url = apply_filters( 'login_redirect', $redirect_to, false, $user ); // phpcs:ignore

				do_action( 'wp_login', $user_login, $user );

				// If empty redirect user to admin page.
				if ( ! empty( $redirect_to_url ) ) {
					$redirect_to = $redirect_to_url;
				}

				wp_safe_redirect( $redirect_to ); // Redirect to given url after successfull login.
			}
			exit();
		}

		if ( is_user_logged_in() ) {

			$user_id = get_current_user_id();
			if ( ! empty( $user_id ) && Wp_Temporary_Login_Without_Password_Common::is_valid_temporary_login( $user_id, false ) ) {
				if ( Wp_Temporary_Login_Without_Password_Common::is_login_expired( $user_id ) ) {
					wp_logout();
					wp_safe_redirect( home_url() );


					exit();
				} else {

					global $pagenow;
					$bloked_pages = Wp_Temporary_Login_Without_Password_Common::get_blocked_pages();
					$page         = ! empty( $_GET['page'] ) ? $_GET['page'] : ''; //phpcs:ignore

					if ( ! empty( $page ) && in_array( $page, $bloked_pages) || ( ! empty( $pagenow ) && ( in_array( $pagenow, $bloked_pages ) ) ) || ( ! empty( $pagenow ) && ( 'users.php' === $pagenow && isset( $_GET['action'] ) && ( 'deleteuser' === $_GET['action'] || 'delete' === $_GET['action'] ) ) ) ) { //phpcs:ignore
						wp_die( esc_attr__( "You don't have permission to access this page", 'temporary-login-without-password' ) );
					}

				}
			}
		}
	}

	/**
	 * Hooked to wp_authenticate_user filter to disable login for temporary user using username/email and password
	 *
	 * @param WP_User $user WP_User object.
	 * @param string  $password password of a user.
	 *
	 * @return \WP_Error
	 */
	public function disable_temporary_user_login( $user, $password ) {

		if ( $user instanceof WP_User ) {
			$check_expiry             = false;
			$is_valid_temporary_login = Wp_Temporary_Login_Without_Password_Common::is_valid_temporary_login( $user->ID, $check_expiry );

			// Is temporary user? Disable Login by throwing error.
			if ( $is_valid_temporary_login ) {
				$user = new WP_Error( 'denied', __( "ERROR: User can't find." ) );
			}
		}

		return $user;
	}

	/**
	 * Hooked to allow_password_reset filter to disable reset password for temporary user
	 *
	 * @param boolean $allow allow to reset password.
	 * @param int     $user_id user_id of a user.
	 *
	 * @return boolean
	 */
	public function disable_password_reset( $allow, $user_id ) {

		if ( is_int( $user_id ) ) {
			$check_expiry             = false;
			$is_valid_temporary_login = Wp_Temporary_Login_Without_Password_Common::is_valid_temporary_login( $user_id, $check_expiry );
			if ( $is_valid_temporary_login ) {
				$allow = false;
			}
		}

		return $allow;
	}

}
