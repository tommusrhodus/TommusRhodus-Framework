<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Widget_TommusRhodus_Inner_Decorations_Block extends Widget_Base {
	
	//Return Class Name
	public function get_name() {
		return 'tommusrhodus-inner-decorations-block';
	}
	
	//Return Block Title (for blocks list)
	public function get_title() {
		return esc_html__( 'Inner Decorations', 'tr-framework' );
	}
	
	//Return Block Icon (for blocks list)
	public function get_icon() {
		return 'eicon-slideshow';
	}
	
	public function get_categories() {
		return [ 'leap-elements' ];
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_my_custom', [
				'label' => esc_html__( 'Inner Decorations Settings', 'tr-framework' ),
			]
		);		

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_items_section', [
				'label' => __( 'Decorations', 'tr-framework' )
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'layout', [
				'label'   => __( 'Choose a Decoration', 'tr-framework' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'blob_top_left',
				'label_block' => true,
				'options' => [
					'blob_top_left'				=> esc_html__( 'Blob, Positon Top Left', 'tr-framework' ),
					'blob_bottom_left'			=> esc_html__( 'Blob, Positon Bottom Left', 'tr-framework' ),
					'blob_bottom_right'			=> esc_html__( 'Blob, Positon Bottom Right', 'tr-framework' ),
					'lines_bottom_right'		=> esc_html__( 'Lines, Positon Bottom Right', 'tr-framework' ),
					'lines_bottom_left'			=> esc_html__( 'Lines, Positon Bottom Left', 'tr-framework' ),
					'lines_top_left'			=> esc_html__( 'Lines, Positon Top Left', 'tr-framework' ),
				],
			]
		);

		$this->add_control(
			'list', [
				'label'   => __( 'Slide Content', 'tr-framework' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [],
				'title_field' => __( 'Slide Content', 'tr-framework' ),
			]
		);		

		$this->end_controls_section();

	}

	protected function render() {
		
		$settings                = $this->get_settings_for_display();
		$user_selected_animation = (bool) $settings['_animation'];	

		foreach( $settings['list'] as $item ){

			if( 'blob_top_left' == $item['layout'] ) {
				echo '
					<div class="decoration decoration-block top left scale-2 d-none d-md-block">
		              <svg class="bg-primary-2" width="43" height="122" viewBox="0 0 43 122" fill="none" xmlns="http://www.w3.org/2000/svg">
		                <path d="M27.7833 0.279065C31.5153 -0.395935 34.1643 0.647081 35.8243 3.52708C37.3013 3.75308 38.6543 3.75507 39.8533 4.18507C42.1543 5.01007 42.9763 6.54608 42.4253 8.85508C41.9003 11.0481 41.2363 13.2141 40.5173 15.3541C39.3333 18.8831 38.0523 22.3801 36.8223 25.8941C36.5623 26.6401 36.3473 27.4031 36.1253 28.1161C37.0183 29.7191 37.8983 31.1721 38.6433 32.6931C38.9753 33.3751 39.2763 34.2291 39.1643 34.9391C38.7993 37.2861 38.4123 39.6531 37.7263 41.9191C34.3003 53.2441 30.6563 64.5041 27.3223 75.8571C24.0643 86.9611 21.6093 98.2541 20.5933 109.813C20.3373 112.721 20.3023 115.648 20.1133 118.563C20.0643 119.327 19.8203 120.077 19.6813 120.759C15.5443 121.634 15.1673 121.063 12.5563 118.159C10.5703 115.952 10.0543 113.611 9.89033 110.991C9.78533 109.283 9.15631 107.965 7.99531 106.752C5.98531 104.652 4.13033 102.404 2.07933 100.35C1.36233 99.6311 0.903309 98.9591 0.886309 97.9751C0.820309 94.3911 0.722321 90.8071 0.698321 87.2231C0.682321 84.7301 1.61831 82.2831 0.753314 79.7161C0.466314 78.8631 1.1893 77.7051 1.3173 76.6701C1.5593 74.6961 1.55332 72.6821 1.92232 70.7361C2.96332 65.2691 4.04931 59.8211 5.40431 54.4081C7.37531 46.5491 9.58832 38.7701 11.8923 31.0121C12.5353 28.8511 13.2773 26.7081 14.1303 24.6221C16.2923 19.3441 18.5343 14.0991 20.7713 8.85109C21.0273 8.24809 21.3243 7.49607 21.8303 7.19307C24.5723 5.55607 25.8093 2.64406 27.7833 0.279065Z"
		                fill="black" />
		              </svg>
		            </div>
				';
			}	

			if( 'lines_bottom_right' == $item['layout'] ) {
				echo '
					<div class="decoration decoration-block bottom middle-x scale-2">
		              <svg class="bg-primary" width="110" height="116" viewBox="0 0 110 116" fill="none" xmlns="http://www.w3.org/2000/svg">
		                <path d="M56.0201 7.05393C59.1721 4.51793 59.7681 4.46094 62.2881 6.41394C62.0951 6.69994 61.9211 7.01594 61.6921 7.28394C61.1841 7.88094 61.1741 7.87095 61.8561 8.97595C61.3271 9.84795 60.7561 10.786 60.1081 11.855C60.6431 12.46 61.1801 13.029 61.6701 13.635C62.1681 14.251 62.7231 14.8549 63.0631 15.5549C63.3851 16.2189 63.4631 17.002 63.6741 17.834C61.8561 18.334 60.2351 18.0659 58.8281 16.7719C58.2441 16.2349 57.6871 15.6679 57.1821 15.1749C56.2431 15.0949 55.7871 15.743 55.2171 16.135C53.3071 17.447 51.3931 18.7399 49.1231 19.3709C48.8961 19.4339 48.6581 19.4569 48.4691 19.4919C48.2741 19.4259 48.1001 19.4089 47.9791 19.3199C46.3381 18.1189 46.1781 17.4189 47.3031 15.8059C47.6551 15.3039 48.1841 14.9089 48.6781 14.5269C49.2421 14.0899 49.8931 13.7629 50.4511 13.3179C53.4801 10.8969 53.0801 11.0889 51.2521 8.46894C49.9811 6.64594 48.9201 4.67293 47.8111 2.73993C47.3131 1.87393 47.3461 0.917928 47.8421 0.536928C48.5101 0.0219278 49.2811 -0.108072 50.1001 0.161928C51.0711 0.481928 51.6641 1.24693 52.2331 2.01593C53.1781 3.29693 54.0751 4.61694 55.0121 5.90494C55.2831 6.28094 55.6231 6.60693 56.0201 7.05393Z"
		                fill="black" />
		                <path d="M45.2522 52.563C45.6802 53.121 45.8982 53.446 46.1582 53.735C46.5842 54.211 47.0332 54.6671 47.4802 55.1261C49.0032 56.6921 49.6262 58.568 49.4842 60.869C48.4452 60.965 47.5882 60.5641 46.7712 60.1421C46.0742 59.7831 45.2692 59.4151 44.8262 58.8201C43.6172 57.1911 41.8062 56.2541 40.6542 54.6871C39.7752 54.8601 39.0842 55.004 38.3882 55.132C37.0792 55.372 36.1932 54.8641 35.8572 53.6091C35.7382 53.1581 35.6072 52.572 35.7912 52.201C36.5312 50.712 35.6662 49.5981 35.0312 48.4401C34.6852 47.8071 34.2602 47.2361 34.2672 46.4651C34.2752 45.6621 34.8082 45.0261 35.6092 45.1341C36.2972 45.2281 37.0002 45.4641 37.6092 45.7971C38.1562 46.0961 38.6462 46.562 39.0502 47.046C40.0402 48.224 41.1552 48.3071 42.4562 47.6401C43.2372 47.2391 44.0502 46.9001 44.8542 46.5481C45.5122 46.2611 46.1842 46.0071 46.8402 45.7201C49.0592 44.7491 50.9102 46.8641 51.0632 48.8941C51.1082 49.5121 50.8132 50.0041 50.2742 50.2671C49.3422 50.7221 48.3762 51.106 47.4302 51.533C46.7832 51.825 46.1452 52.14 45.2522 52.563Z"
		                fill="black" />
		                <path d="M70.824 40.181C70.357 40.472 69.8729 40.739 69.4259 41.059C68.7969 41.512 68.141 41.636 67.364 41.35C66.548 40.289 66.532 39.2 67.315 38.089C67.999 37.12 68.6859 36.153 69.4609 35.058C68.9789 34.524 68.5389 33.972 68.0329 33.488C66.9839 32.484 66.2029 31.295 65.4179 30.087C64.7319 29.033 64.717 28.035 65.203 26.77C65.746 26.841 66.348 26.767 66.769 27.007C67.589 27.474 68.3569 28.067 69.0599 28.701C70.2439 29.764 71.359 30.901 72.527 32.03C73.672 31.734 74.2299 30.79 75.0039 30.147C75.9019 29.399 76.8419 28.883 78.0629 29.19C78.6059 29.326 79.135 29.419 79.514 29.923C79.793 30.297 80.1859 30.585 80.6119 30.991C80.5589 33.131 78.7249 34.322 77.6329 36.135C77.8769 36.432 78.123 36.818 78.449 37.114C79.707 38.251 80.2669 39.66 80.2009 41.443C78.6309 42.078 77.3239 41.327 76.0429 40.561C75.6409 40.32 75.318 39.938 74.984 39.596C74.466 39.065 73.8379 39.13 73.1969 39.21L73.2399 39.261C72.8629 39.052 72.4879 38.923 72.1189 39.277C72.0019 39.344 71.8919 39.422 71.7909 39.511C71.4469 39.75 71.103 39.99 70.76 40.228L70.824 40.181Z"
		                fill="black" />
		                <path d="M96.1969 45.298C95.2609 44.256 94.5079 43.44 93.7809 42.602C93.1009 41.821 92.3918 41.057 91.8038 40.21C91.1558 39.277 91.7079 38.274 92.8249 38.171C93.6489 38.095 94.4229 38.198 95.0869 38.719C95.8369 39.307 96.5689 39.916 97.2979 40.528C98.0269 41.139 98.7389 41.766 99.5419 42.457C100.458 42.04 101.009 41.271 101.649 40.588C102.602 39.573 104.172 39.237 105.364 39.766C106.288 40.176 106.975 40.789 106.88 41.942C106.847 42.334 106.837 42.738 106.896 43.124C107.029 43.992 106.81 44.633 106.05 45.176C105.421 45.624 104.941 46.275 104.413 46.816C104.772 47.655 105.151 48.343 105.358 49.079C105.542 49.736 105.532 50.447 105.631 51.329C103.625 51.114 101.963 50.533 100.447 49.324C99.7199 49.663 99.0109 49.994 98.3009 50.325C96.8339 51.011 95.2909 51.363 93.6699 51.312C92.8299 51.286 92.3768 50.75 92.3728 49.925C92.3648 48.594 93.1519 47.706 94.0639 46.91C94.6599 46.395 95.3219 45.956 96.1969 45.298Z"
		                fill="black" />
		                <path d="M101.844 91.355C102.533 90.708 103.045 90.219 103.565 89.738C104.352 89.009 105.28 88.59 106.346 88.473C107.282 88.371 108.116 88.97 108.166 89.915C108.268 91.837 108.137 93.727 106.768 95.423C108.45 96.804 109.608 98.433 109.563 100.773C108.346 101.144 107.262 100.505 106.223 100.104C105.217 99.716 104.348 98.97 103.33 98.326C101.726 98.993 100.053 99.693 98.373 100.385C98.08 100.506 97.783 100.629 97.475 100.697C96.645 100.881 95.815 100.256 95.86 99.408C95.889 98.869 96.03 98.293 96.278 97.814C96.825 96.761 97.471 95.758 98.178 94.563C98.037 94.205 97.905 93.663 97.625 93.21C97.336 92.741 96.9 92.363 96.541 91.937C95.252 90.409 94.629 88.672 94.853 86.662C96.527 86.557 97.419 86.893 98.632 88.123C99.193 88.691 99.696 89.314 100.253 89.885C100.695 90.336 101.18 90.745 101.844 91.355Z"
		                fill="black" />
		                <path d="M23.8872 15.5589C22.6252 16.2679 21.4532 16.9369 20.2702 17.5889C19.5822 17.9669 18.9482 18.371 18.0512 18.294C17.4892 18.246 16.8932 18.718 16.2972 18.911C15.7872 19.078 15.3522 18.905 15.0652 18.445C14.5652 17.646 14.4672 16.811 14.8952 15.945C15.4382 14.842 16.2172 13.9829 17.3132 13.3779C18.2802 12.8449 19.3152 12.3549 19.9202 11.1969C19.3592 9.76695 17.7032 9.25894 16.9362 8.01094C16.8932 7.24394 17.2312 6.65994 17.8252 6.39894C18.7062 6.00994 19.6772 5.88596 20.6122 6.28096C21.1262 6.49696 21.6142 6.77695 22.0922 7.06395C22.7742 7.47495 23.4342 7.91995 24.2092 8.41795C24.7172 8.15295 25.2932 7.89896 25.8202 7.56496C26.7812 6.95896 27.7732 7.01394 28.8182 7.26094C29.9662 7.53194 30.3612 8.55595 30.9042 9.37795C31.0842 9.64995 30.8492 10.318 30.6272 10.7C30.3972 11.094 29.9572 11.3709 29.5922 11.6789C29.1082 12.0869 28.6082 12.4749 28.1312 12.8569C28.4202 14.3099 28.7292 15.684 28.9552 17.071C29.0742 17.812 28.4632 18.199 27.7152 17.906C27.0492 17.645 26.3522 17.423 25.7442 17.057C25.1452 16.698 24.6412 16.1789 23.8872 15.5589Z"
		                fill="black" />
		                <path d="M69.8009 69.525C69.1799 68.537 68.5409 67.532 67.9119 66.521C67.3529 65.621 67.0229 64.642 67.0159 63.58C67.0039 62.432 67.9179 61.762 68.9379 62.264C69.6289 62.604 70.2659 63.135 70.8009 63.7C71.5629 64.504 72.2109 65.417 72.9669 66.358C73.7209 66.049 74.4259 65.711 75.1619 65.469C76.9219 64.891 78.1719 65.803 78.5489 67.666C78.8359 69.082 78.6329 70.163 77.2109 70.859C77.6349 73.103 79.7929 74.8 79.2129 77.494C77.3889 76.984 75.6059 76.826 74.3259 75.264C73.4779 74.231 72.7649 74.256 71.6149 75.024C70.6209 75.686 69.6499 76.385 68.6399 77.02C67.9329 77.464 67.2119 77.227 66.8369 76.483C66.2609 75.338 66.1319 74.174 66.9419 73.094C67.7969 71.954 68.7209 70.867 69.8009 69.525Z"
		                fill="black" />
		                <path d="M11.2291 50.851C12.3481 53.413 12.3931 53.754 11.8481 55.872C11.4161 55.737 10.9671 55.659 10.5781 55.459C9.80111 55.06 8.99812 54.671 8.31212 54.141C6.20712 52.516 6.17311 52.571 3.67711 53.987C3.16711 53.747 2.60311 53.481 2.13611 53.261C1.51111 51.93 1.95211 50.83 2.50511 49.796C1.85111 48.519 1.2841 47.296 0.616104 46.134C-0.160896 44.784 -0.115892 43.569 1.02611 42.371C3.56311 42.53 4.2331 45.257 6.2921 46.302C7.2761 46.048 7.9011 45.2 8.5631 44.438C9.0941 43.825 9.64111 43.278 10.4181 42.984C12.0331 42.374 13.3071 42.783 14.3031 44.259C15.3191 45.762 15.3601 46.257 14.2371 47.622C13.3361 48.723 12.2991 49.713 11.2291 50.851Z"
		                fill="black" />
		                <path d="M103.832 64.201C106.49 63.505 107.318 63.6351 108.391 64.8361C109.336 65.8931 109.405 66.6721 108.692 68.6721C109.68 70.3131 110.381 72.0931 109.698 74.3111C109.05 73.9241 108.542 73.5901 108.005 73.3091C107.368 72.9771 106.683 72.735 106.067 72.373C105.526 72.054 105.049 71.6231 104.512 71.2161C103.106 71.6291 101.725 72.0101 100.362 72.4441C99.5981 72.6871 98.8421 73.1131 98.1711 72.3221C97.5541 71.5961 97.4911 70.3191 98.0711 69.4281C98.4561 68.8361 98.9441 68.3051 99.4261 67.7831C99.6801 67.5081 100.02 67.3081 100.401 67.0121C100.012 66.4651 99.6881 66.0281 99.3831 65.5781C98.6251 64.4541 97.8771 63.3241 97.1211 62.1971C96.2131 60.8421 96.2541 59.3161 96.4511 57.8141C96.5131 57.3341 97.0121 56.9111 97.2651 56.5281C98.2981 56.5371 98.6011 57.2771 99.0091 57.8311C100.142 59.3731 101.212 60.9631 102.347 62.5041C102.811 63.1331 103.377 63.686 103.832 64.201Z"
		                fill="black" />
		                <path d="M107.551 8.04991C106.336 9.03991 105.123 10.0309 103.949 10.9879C104.795 13.7779 104.896 14.5269 104.662 16.3629C102.621 15.9779 101.082 14.7979 99.6482 13.3439C97.8102 13.9219 95.9982 14.4909 94.1682 15.0659C93.5982 14.7179 93.0662 14.3949 92.5762 14.0969C92.1762 12.8759 93.1172 12.2839 93.6832 11.5759C94.2242 10.9019 94.9212 10.3529 95.5582 9.74193C95.4432 8.91993 94.7202 8.62893 94.1812 8.19493C93.6282 7.74893 93.0312 7.35792 92.4842 6.96492C92.9982 5.24492 93.9632 4.56193 95.4272 4.95393C96.4192 5.21993 97.3762 5.64192 98.3232 6.05492C98.8992 6.30792 99.4272 6.67694 100.096 7.06194C100.524 6.76194 100.965 6.45292 101.407 6.14192C102.319 5.49992 103.19 4.78992 104.151 4.23192C105.473 3.46392 107.128 3.76191 108.051 4.89891C108.604 5.57991 108.459 6.38891 108.197 7.16591C108.31 6.78191 108.156 6.50592 107.783 6.70192C107.201 7.00592 107.16 7.51791 107.551 8.04991Z"
		                fill="black" />
		                <path d="M16.3109 105.689C16.0039 105.412 15.8518 105.205 15.6488 105.103C13.2268 103.898 11.4479 101.953 9.70985 99.96C9.50485 99.724 9.26885 99.465 9.18885 99.177C9.06785 98.738 8.90787 98.2 9.05787 97.82C9.27887 97.266 9.85485 97.515 10.3219 97.603C11.7479 97.873 13.0599 98.323 14.2729 99.205C15.4919 100.092 16.8879 100.73 18.2089 101.473C18.9839 101.909 19.7729 102.17 20.7109 102.112C22.2789 102.016 23.4749 102.688 24.1719 104.163C24.3399 104.515 24.6349 104.808 24.8789 105.122C25.4399 105.849 25.7969 106.579 25.4039 107.554C25.2559 107.923 25.4369 108.427 25.4779 109.033C24.2769 108.762 23.2789 108.537 22.3449 108.327C20.9969 109.16 19.7489 110.016 18.4229 110.727C17.1609 111.403 15.8179 111.926 14.5749 112.487C13.8699 111.966 13.2059 111.532 12.6119 111.016C12.2289 110.682 12.0728 110.155 12.4208 109.722C12.9128 109.105 13.4479 108.496 14.0599 108.004C14.8709 107.353 15.7149 106.758 16.3109 105.689Z"
		                fill="black" />
		                <path d="M49.1802 86.532C49.6552 88.307 50.2012 90.069 49.4182 92.006C47.9752 92.111 46.9712 91.287 46.0572 90.28C45.5362 89.706 45.0282 89.119 44.4832 88.502C43.6042 88.721 42.8542 88.906 42.0202 89.113C41.3502 87.704 42.0082 86.396 41.9362 84.813C41.0822 83.431 40.0862 81.808 39.0812 80.192C38.8272 79.786 38.5153 79.416 38.2823 79C37.7573 78.061 38.2622 77.047 39.3392 76.835C40.2572 76.654 41.1092 76.844 41.7962 77.458C42.4462 78.04 43.0152 78.715 43.6162 79.352C44.2122 79.982 44.6652 80.771 45.6732 81.115C45.8682 80.995 46.2143 80.897 46.3683 80.671C47.3063 79.299 48.6432 79.369 50.0182 79.622C50.9912 79.802 51.8252 80.741 51.9832 81.744C52.0322 82.058 52.0492 82.378 52.1002 82.692C52.2072 83.374 52.0393 83.926 51.4933 84.395C50.7133 85.066 49.9792 85.789 49.1802 86.532Z"
		                fill="black" />
		                <path d="M67.0101 115.141C67.0281 114.983 67.0451 114.825 67.0781 114.52C66.5881 114.52 66.0961 114.557 65.6131 114.502C65.4001 114.479 65.1521 114.313 65.0151 114.136C64.7281 113.767 64.5051 113.348 64.2921 113.008C64.7801 111.246 65.6731 109.895 67.3801 109.008C66.3231 107.477 65.0621 106.319 63.8101 105.217C64.2611 103.867 65.351 103.764 66.369 103.842C67.221 103.906 68.0641 104.25 68.8751 104.565C69.4591 104.794 69.98 105.178 70.58 105.521C71.488 104.877 72.3441 104.182 73.2811 103.627C74.8771 102.682 76.9781 103.578 77.4201 105.334C77.4571 105.48 77.4711 105.715 77.3871 105.795C76.7871 106.361 77.0181 107.047 77.0161 107.722C77.0161 107.998 76.7501 108.287 76.5691 108.544C76.2491 109 75.9011 109.436 75.4791 109.994C75.4791 111.053 75.4791 112.223 75.4791 113.238C74.8111 113.9 74.2801 113.631 73.7881 113.39C72.4381 112.734 71.2221 112.945 69.9761 113.738C69.0501 114.328 68.1031 114.957 66.9531 115.078L67.0101 115.141Z"
		                fill="black" />
		                <path d="M18.5682 79.488C20.3222 82.367 20.4922 83.267 19.5802 85.064C18.3182 84.46 16.9713 84.06 15.8593 83.108C14.8753 82.265 14.1542 82.273 13.0562 82.98C12.7242 83.195 12.4112 83.45 12.1202 83.718C11.4792 84.312 10.7782 84.134 10.1282 83.826C9.54424 83.55 9.48924 82.961 9.58924 82.376C9.72424 81.595 9.75326 80.769 10.0403 80.046C10.5073 78.871 10.3513 77.885 9.57126 76.934C9.37226 76.691 9.19426 76.405 9.10026 76.109C8.91426 75.513 8.62326 74.88 9.17026 74.318C9.62726 73.849 10.2113 73.959 10.7463 74.107C11.1973 74.234 11.6292 74.453 12.0512 74.669C12.4732 74.886 12.8732 75.148 13.4012 75.461C13.8402 75.044 14.2622 74.596 14.7312 74.207C15.6982 73.408 16.7843 72.988 18.0533 73.334C19.0453 73.604 19.6702 74.367 19.7662 75.389C19.9322 77.162 19.8552 77.431 18.5682 79.488Z"
		                fill="black" />
		              </svg>
		            </div>
				';
			}		

			if( 'blob_bottom_left' == $item['layout'] ) {
				echo '
					<div class="decoration decoration-block bottom left" data-aos="fade-up">
		              <svg class="bg-primary" width="260" height="160" viewBox="0 0 260 160" fill="none" xmlns="http://www.w3.org/2000/svg">
		                <path d="M259.455 70.69C259.549 81.425 258.285 91.476 256.723 101.5C255.75 107.739 254.741 113.973 253.793 120.216C253.272 123.658 253.016 127.152 252.309 130.553C251.914 132.455 251.061 134.358 250.02 136.01C248.553 138.334 247.721 140.777 247.452 143.469C247.352 144.46 247.276 145.469 247.018 146.424C246.094 149.85 243.805 151.926 240.278 152.031C236.299 152.15 232.272 152.2 228.331 151.733C214.925 150.144 201.481 149.879 188.015 150.246C184.869 150.332 181.734 150.853 178.599 151.223C174.31 151.728 170.035 152.36 165.74 152.791C160.949 153.271 156.142 153.861 151.34 153.896C147.037 153.929 142.729 153.304 138.428 152.913C135.616 152.658 132.78 152.482 130.014 151.954C124.705 150.94 119.436 151.424 114.147 151.932C113.485 151.995 112.819 152.092 112.159 152.068C102.048 151.707 92.3718 154.415 82.6568 156.532C74.1448 158.387 65.6488 159.497 56.9518 159.12C52.1158 158.911 47.8618 157.293 44.2628 154.038C40.3218 150.473 36.4308 146.852 32.4598 143.319C30.8488 141.886 29.1588 140.514 27.3758 139.307C23.4348 136.64 20.4418 133.227 18.0988 129.069C13.3288 120.618 9.20281 111.955 7.65781 102.262C7.55381 101.607 7.3958 100.957 7.2298 100.314C6.1908 96.293 5.2378 92.248 4.0778 88.262C2.2148 81.85 0.571797 75.405 0.979797 68.658C1.1498 65.853 1.55581 63.055 2.00681 60.279C2.29981 58.48 2.8018 56.705 3.3248 54.954C5.7158 46.961 7.0748 38.773 7.8858 30.494C8.3918 25.32 9.60281 20.381 11.6968 15.613C13.3508 11.846 15.7128 8.84097 19.1968 6.55897C27.8848 0.871973 37.1478 -0.681028 47.3118 1.48997C53.8668 2.88997 60.0558 5.23799 66.3218 7.44499C74.3058 10.257 82.4408 11.128 90.8688 9.80897C98.7418 8.57597 106.65 7.36398 114.59 6.78898C123.358 6.15498 132.18 5.75698 140.926 7.59398C151.371 9.78798 161.944 10.817 172.633 10.495C175.623 10.405 178.623 10.56 181.613 10.447C193.99 9.97397 205.607 13.012 217.019 17.532C223.023 19.909 228.191 23.388 233.035 27.467C237.988 31.636 242.894 35.872 247.654 40.258C249.588 42.039 251.371 44.124 252.716 46.373C254.845 49.931 256.62 53.71 258.413 57.458C259.815 60.395 259.61 63.625 259.684 66.771C259.717 68.261 259.514 69.757 259.455 70.69ZM188.312 109.787L188.011 109.598L187.966 109.906L188.312 109.787Z"
		                fill="black" />
		              </svg>
		            </div>
				';
			}	

			if( 'lines_bottom_left' == $item['layout'] ) {
				echo '
					<div class="decoration decoration-block bottom left" data-aos="fade-right">
		              <svg class="bg-primary-2" width="177" height="40" viewBox="0 0 177 40" fill="none" xmlns="http://www.w3.org/2000/svg">
		                <path d="M176.123 39.7359C175.478 39.7539 174.855 39.8269 174.242 39.7769C170.656 39.4889 167.072 39.1749 163.49 38.8589C163.013 38.8179 162.523 38.7829 162.074 38.6339C159.541 37.7899 156.908 37.6619 154.277 37.4949C151.484 37.3189 148.693 37.1279 145.904 36.9159C137.927 36.3109 129.935 36.1449 121.943 35.9849C118.191 35.9109 114.437 35.8699 110.683 35.8189C102.611 35.7079 94.5379 35.6229 86.4659 35.4789C82.5519 35.4109 78.6399 35.2639 74.7279 35.0959C71.1379 34.9419 67.5439 34.7819 63.9619 34.4979C60.3799 34.2139 56.8099 33.7729 53.2349 33.4039C51.0919 33.1829 48.9479 32.9899 46.8089 32.7499C42.6819 32.2869 38.5469 31.8829 34.4379 31.2949C30.8849 30.7849 27.3699 30.0239 23.8269 29.4309C20.5199 28.8769 17.1999 28.3969 13.8859 27.8889C11.3609 27.4999 8.83285 27.1369 6.31185 26.7229C5.20285 26.5409 4.11485 26.3279 2.99585 26.6609C2.29285 26.8699 1.78286 26.5279 1.31986 26.0139C0.505856 25.1049 0.385845 24.0069 0.436845 22.8759C0.461845 22.3359 0.838856 21.9889 1.37586 21.9639C1.93086 21.9399 2.49286 21.9869 3.04586 22.0559C6.45786 22.4729 9.86185 22.9469 13.2759 23.3229C20.2719 24.0939 27.1859 25.3849 34.1159 26.5539C38.4599 27.2879 42.8209 27.7809 47.1899 28.2399C52.3519 28.7829 57.5399 29.0959 62.6979 29.6599C70.4149 30.5039 78.1509 30.8669 85.9049 30.9709C91.2549 31.0409 96.6079 30.9939 101.958 31.0969C110.19 31.2539 118.419 31.5019 126.651 31.6919C129.368 31.7549 132.09 31.6799 134.805 31.7969C140.793 32.0589 146.785 32.3089 152.764 32.7369C158.817 33.1709 164.856 33.7929 170.897 34.3809C172.083 34.4959 173.258 34.7829 174.413 35.0909C174.829 35.2019 175.374 35.5309 175.505 35.8909C175.936 37.0619 176.463 38.2559 176.123 39.7359Z"
		                fill="black" />
		                <path d="M8.59619 2.86295C9.31119 2.68995 9.8322 2.44794 10.3482 2.45994C12.0262 2.50094 13.7002 2.61996 15.3752 2.73396C18.9572 2.97896 22.5372 3.38394 26.1252 3.46394C34.9862 3.66194 43.8482 4.19895 52.7172 3.69795C56.8622 3.46395 61.0102 3.29694 65.1562 3.11594C67.5492 3.01194 69.9432 2.94496 72.3382 2.85896C72.9772 2.83596 73.6172 2.83496 74.2542 2.77296C79.5842 2.25296 84.9402 2.22594 90.2852 1.97794C94.1152 1.79894 97.9432 1.54695 101.773 1.40995C106.324 1.24595 110.878 1.03995 115.427 1.08195C126.302 1.18295 137.167 0.948947 148.034 0.624947C152.343 0.496947 156.663 0.595932 160.975 0.665932C162.409 0.688932 163.836 0.932932 165.266 1.09693C166.348 1.22193 167.248 1.73193 167.893 2.59693C168.588 3.52993 169.555 4.32993 169.649 5.80393C169.17 5.89993 168.731 6.08594 168.307 6.05494C166 5.88594 163.702 5.60994 161.395 5.47794C159.723 5.38294 158.04 5.41296 156.362 5.46296C151.022 5.62196 145.682 5.83394 140.342 5.98594C138.186 6.04794 136.028 6.00095 133.869 6.01395C131.715 6.02795 129.558 6.08295 127.404 6.07295C122.779 6.04895 118.152 5.89295 113.529 5.97895C108.021 6.08195 102.519 6.37894 97.0132 6.59394C95.5832 6.64994 94.1542 6.69794 92.7262 6.77094C89.8612 6.91894 86.9942 7.07094 84.1302 7.24494C81.2592 7.41894 78.3923 7.63895 75.5232 7.80695C72.4962 7.98495 69.4641 8.10595 66.4391 8.28895C63.4141 8.47195 60.3922 8.73296 57.3672 8.90296C50.7422 9.27496 44.1111 9.18295 37.4821 9.08695C35.1731 9.05395 32.8751 8.75994 30.5681 8.62794C25.3981 8.32994 20.2342 7.82095 15.0912 7.19495C13.5952 7.01295 12.1141 6.83094 10.6111 6.80994C9.65219 6.79594 9.0642 6.40194 8.8842 5.53394C8.7292 4.76394 8.70919 3.96395 8.59619 2.86295Z"
		                fill="black" />
		              </svg>
		            </div>
				';
			}	

			if( 'lines_top_left' == $item['layout'] ) {
				echo '
					<div class="decoration decoration-block top left scale-2" data-aos="fade-up">
		              <svg class="bg-primary-2" width="184" height="91" viewBox="0 0 184 91" fill="none" xmlns="http://www.w3.org/2000/svg">
		                <path d="M183.861 90.676C183.216 90.694 182.593 90.768 181.978 90.718C178.394 90.43 174.81 90.115 171.228 89.799C170.751 89.758 170.259 89.723 169.812 89.574C167.279 88.731 164.646 88.602 162.015 88.436C159.222 88.259 156.431 88.068 153.642 87.857C145.665 87.251 137.673 87.086 129.681 86.925C125.927 86.851 122.173 86.811 118.421 86.759C110.349 86.648 102.276 86.563 94.2042 86.419C90.2902 86.351 86.3782 86.204 82.4662 86.036C78.8742 85.883 75.2822 85.722 71.7002 85.438C68.1182 85.154 64.5482 84.713 60.9732 84.344C58.8302 84.123 56.6862 83.93 54.5472 83.69C50.4202 83.227 46.2852 82.824 42.1762 82.235C38.6232 81.726 35.1062 80.964 31.5652 80.371C28.2562 79.817 24.9382 79.338 21.6242 78.829C19.0992 78.44 16.5692 78.077 14.0502 77.663C12.9412 77.481 11.8532 77.268 10.7342 77.601C10.0312 77.81 9.5192 77.468 9.0582 76.954C8.2422 76.045 8.12421 74.948 8.17521 73.816C8.20021 73.277 8.5772 72.929 9.1142 72.905C9.6692 72.881 10.2312 72.928 10.7842 72.996C14.1942 73.414 17.5982 73.887 21.0142 74.264C28.0082 75.034 34.9242 76.325 41.8542 77.495C46.1982 78.228 50.5592 78.721 54.9282 79.18C60.0902 79.723 65.2762 80.036 70.4362 80.6C78.1532 81.444 85.8892 81.807 93.6432 81.911C98.9932 81.982 104.346 81.935 109.696 82.038C117.926 82.194 126.157 82.443 134.389 82.633C137.106 82.695 139.828 82.62 142.543 82.738C148.531 82.999 154.523 83.249 160.5 83.677C166.555 84.111 172.594 84.733 178.635 85.321C179.821 85.436 180.996 85.723 182.149 86.032C182.567 86.143 183.11 86.471 183.243 86.831C183.674 88.002 184.201 89.195 183.861 90.676Z"
		                fill="black" />
		                <path d="M15.541 53.8029C16.256 53.6289 16.777 53.3869 17.293 53.4009C18.969 53.4399 20.645 53.5609 22.318 53.6739C25.902 53.9179 29.482 54.3239 33.068 54.4039C41.929 54.6009 50.791 55.1379 59.662 54.6379C63.805 54.4039 67.953 54.2359 72.101 54.0559C74.494 53.9519 76.888 53.8839 79.281 53.7979C79.92 53.7759 80.562 53.7749 81.197 53.7119C86.529 53.1919 91.885 53.1649 97.228 52.9169C101.058 52.7379 104.886 52.4849 108.718 52.3489C113.267 52.1849 117.822 51.9789 122.372 52.0209C133.245 52.1229 144.11 51.8879 154.977 51.5639C159.288 51.4369 163.606 51.5369 167.92 51.6059C169.352 51.6279 170.781 51.8729 172.209 52.0369C173.291 52.1619 174.193 52.6719 174.838 53.5369C175.531 54.4709 176.5 55.2699 176.594 56.7439C176.114 56.8399 175.674 57.0269 175.25 56.9959C172.945 56.8269 170.646 56.5509 168.338 56.4189C166.666 56.3239 164.983 56.3539 163.307 56.4039C157.965 56.5619 152.625 56.7749 147.286 56.9269C145.13 56.9879 142.972 56.9409 140.815 56.9549C138.659 56.9689 136.504 57.0239 134.348 57.0129C129.723 56.9899 125.096 56.8339 120.473 56.9189C114.967 57.0229 109.463 57.3199 103.957 57.5339C102.529 57.5909 101.1 57.6379 99.67 57.7119C96.805 57.8599 93.94 58.0129 91.074 58.1869C88.205 58.3609 85.338 58.5799 82.467 58.7489C79.44 58.9269 76.41 59.0479 73.383 59.2299C70.358 59.4129 67.338 59.6739 64.311 59.8439C57.688 60.2149 51.057 60.1229 44.428 60.0279C42.117 59.9939 39.819 59.6999 37.512 59.5669C32.342 59.2699 27.178 58.7599 22.037 58.1349C20.539 57.9509 19.06 57.7709 17.555 57.7489C16.596 57.7349 16.008 57.3419 15.83 56.4739C15.672 55.7029 15.654 54.9029 15.541 53.8029Z"
		                fill="black" />
		                <path d="M1.25602 29.021C2.34802 28.979 3.37703 28.9121 4.40803 28.9061C13.281 28.8541 22.154 28.8911 31.025 28.7421C37.736 28.6291 44.443 28.168 51.154 28.069C57.386 27.977 63.621 28.133 69.853 28.227C74.087 28.29 78.324 28.3941 82.556 28.5491C90.294 28.8331 98.029 29.18 105.767 29.478C111.277 29.691 116.788 29.844 122.296 30.069C126.368 30.236 130.437 30.481 134.509 30.68C136.265 30.766 138.023 30.8321 139.78 30.8931C149.048 31.2131 158.317 31.511 167.583 31.857C170.698 31.974 173.815 32.141 176.921 32.421C178.581 32.571 180.232 32.9461 181.853 33.3541C182.419 33.4971 183.136 33.9391 183.337 34.4281C183.714 35.3471 184.202 36.3271 183.88 37.4071C183.724 37.9281 183.234 38.1981 182.53 38.1091C181.102 37.9311 179.68 37.717 178.253 37.554C171.747 36.81 165.208 36.508 158.671 36.231C152.202 35.957 145.726 35.859 139.255 35.595C134.704 35.409 130.159 35.074 125.612 34.806C122.915 34.647 120.216 34.505 117.52 34.332C115.374 34.194 113.227 34.0501 111.086 33.8541C109.584 33.7161 108.107 33.533 106.574 33.675C105.002 33.821 103.39 33.6861 101.806 33.5491C100.464 33.4321 99.144 33.074 97.802 32.94C96.781 32.837 95.722 32.798 94.71 32.94C91.911 33.33 89.148 32.791 86.37 32.779C84.302 32.771 82.247 32.569 80.179 32.541C78.224 32.515 76.228 32.7731 74.277 32.2691C73.675 32.1141 72.99 32.086 72.382 32.203C71.669 32.34 71.005 32.624 70.37 32.037C70.323 31.993 70.19 31.967 70.147 31.999C68.915 32.939 67.686 31.946 66.456 31.994C65.106 32.046 63.755 31.888 62.421 32.309C61.919 32.467 61.292 32.4561 60.784 32.3081C59.526 31.9421 58.292 32.183 57.044 32.248C55.773 32.314 54.466 32.5511 53.237 32.3411C51.948 32.1201 50.71 32.166 49.452 32.304C47.235 32.547 45.018 32.1701 42.807 32.3241C39.498 32.5551 36.168 32.4471 32.881 33.0141C32.18 33.1351 31.455 33.1821 30.742 33.1651C28.449 33.1111 26.158 33.4151 23.857 32.8901C22.66 32.6171 21.334 32.442 20.091 33.069C19.767 33.232 19.312 33.1821 18.921 33.1601C14.228 32.8901 9.53802 33.0651 4.85102 33.2731C4.53102 33.2871 4.21002 33.2991 3.89402 33.3421C1.61102 33.6581 0.630023 32.407 0.869023 29.974C0.895023 29.751 1.04302 29.538 1.25602 29.021Z"
		                fill="black" />
		                <path d="M182.207 16.842C181.119 16.441 180.186 16.073 179.234 15.752C178.332 15.447 177.404 15.424 176.441 15.391C173.332 15.282 170.218 15.062 167.132 14.675C165.357 14.452 163.636 14.721 161.89 14.744C160.933 14.757 160.023 14.776 159.072 14.489C158.347 14.27 157.441 14.255 156.722 14.485C155.288 14.945 153.923 14.565 152.527 14.479C150.48 14.352 148.466 13.933 146.371 14.316C144.91 14.583 143.367 14.384 141.859 14.404C139.869 14.43 137.877 14.505 135.886 14.487C134.698 14.476 133.513 14.33 132.327 14.241C132.091 14.223 131.813 14.092 131.628 14.174C129.851 14.956 128.007 14.236 126.196 14.418C124.794 14.559 123.344 14.204 121.915 14.125C120.886 14.068 119.843 14.018 118.821 14.114C116.272 14.353 113.743 13.789 111.194 13.991C110.005 14.086 108.796 13.926 107.606 14.026C104.96 14.251 102.348 13.896 99.725 13.706C99.176 13.666 98.598 13.626 98.071 13.745C97.354 13.907 96.669 13.858 95.948 13.839C93.096 13.763 90.243 13.807 87.423 13.256C87.038 13.181 86.626 13.217 86.228 13.228C81.359 13.355 76.529 12.822 71.701 12.325C66.623 11.803 61.556 11.158 56.484 10.591C54.904 10.415 53.31 10.375 51.738 10.165C49.052 9.80604 46.392 9.21104 43.699 8.99304C40.519 8.73604 37.412 8.00003 34.23 7.78003C32.406 7.65303 30.593 7.33303 28.781 7.07303C24.916 6.52003 21.051 5.96803 17.191 5.37503C15.855 5.17003 14.535 4.85203 13.209 4.57703C11.572 4.23803 9.93802 3.89303 8.25402 4.17703C7.74802 3.32803 8.13102 2.95904 8.65402 2.32904C9.29502 1.55504 9.94701 1.98802 10.603 1.87802C10.88 1.48502 11.148 1.10802 11.49 0.624023C12.886 0.715023 14.326 0.733039 15.744 0.915039C21.213 1.61604 26.678 2.35402 32.14 3.10602C38.236 3.94602 44.322 4.84202 50.421 5.66302C53.669 6.10102 56.931 6.44203 60.189 6.80603C65.748 7.42703 71.302 8.10302 76.873 8.61902C80.689 8.97302 84.525 9.16004 88.359 9.30704C94.666 9.54704 100.976 9.77702 107.287 9.86002C114.955 9.96102 122.627 9.95004 130.297 9.90604C141.406 9.84204 152.516 9.65702 163.627 9.62402C167.541 9.61302 171.457 9.85503 175.369 10.065C176.799 10.142 178.224 10.417 179.635 10.686C180.33 10.819 181.024 11.074 181.653 11.4C182.505 11.842 182.794 12.617 182.575 13.623C182.458 14.165 182.175 14.679 182.108 15.223C182.045 15.741 182.166 16.278 182.207 16.842ZM10.258 3.24304C10.309 3.13004 10.369 3.02005 10.404 2.90305C10.41 2.88105 10.279 2.78403 10.259 2.79703C10.157 2.86403 10.073 2.95402 9.98201 3.03702C10.074 3.10502 10.166 3.17404 10.258 3.24304ZM42.617 7.58704C42.504 7.64404 42.322 7.67803 42.295 7.76303C42.262 7.86403 42.361 8.00903 42.402 8.13403C42.556 8.06203 42.713 7.98902 42.867 7.91702C42.785 7.80802 42.701 7.69804 42.617 7.58704ZM13.744 3.13702C13.683 3.15702 13.623 3.17604 13.562 3.19604C13.642 3.24604 13.72 3.30404 13.806 3.33704C13.826 3.34504 13.878 3.26404 13.915 3.22504C13.859 3.19504 13.801 3.16702 13.744 3.13702Z"
		                fill="black" />
		              </svg>
		            </div>
				';
			}			

			if( 'blob_bottom_right' == $item['layout'] ) {
				echo '
					<div class="decoration decoration-block bottom right" data-aos="fade-up">
		              <svg class="bg-primary-2" width="298" height="197" viewBox="0 0 298 197" fill="none" xmlns="http://www.w3.org/2000/svg">
		                <path d="M271.518 116.857C266.116 125.511 259.584 133.287 253.194 141.164C248.36 147.125 243.548 153.103 238.583 158.953C236.134 161.84 233.362 164.453 230.733 167.185C229.881 168.072 228.921 168.871 228.172 169.833C225.727 172.979 222.572 175.452 220.145 178.651C217.581 182.032 213.84 184.145 210.204 186.288C201.958 191.145 193.024 193.809 183.61 195.366C174.13 196.932 164.633 196.987 155.102 196.749C148.211 196.575 141.723 194.466 135.547 191.72C126.522 187.704 117.201 184.554 107.795 181.695C102.133 179.974 96.211 179.015 90.348 178.072C82.455 176.801 74.483 176.021 66.59 174.748C61.49 173.924 56.395 173.656 51.27 173.844C41.399 174.205 31.62 172.856 21.799 172.319C17.233 172.069 12.623 171.329 8.32199 169.428C3.47399 167.289 0.64998 163.86 0.50198 158.356C0.33398 152.055 1.14497 145.872 2.36097 139.725C4.05597 131.147 6.94698 122.92 9.63998 114.625C11.435 109.1 14.044 104.068 17.138 99.191C20.263 94.261 22.833 88.964 26.156 84.181C28.943 80.169 32.218 76.415 35.73 73.013C39.232 69.62 43.835 67.853 48.488 66.47C49.535 66.159 50.73 66.247 51.851 66.298C56.263 66.493 60.572 67.214 64.898 68.22C71.472 69.749 77.906 72.04 84.709 72.466C87.564 72.646 90.438 72.616 93.301 72.558C98.117 72.46 102.93 72.236 107.746 72.117C113 71.986 117.902 70.75 122.18 67.582C129.756 61.973 137.328 56.355 144.856 50.678C150.336 46.543 155.829 42.416 161.157 38.088C167.837 32.662 174.261 26.918 180.968 21.529C186.708 16.916 192.419 12.265 198.823 8.50796C202.481 6.35996 206.471 5.08997 210.255 3.29897C212.142 2.40397 214.415 2.16795 216.544 1.97295C222.355 1.43795 228.177 0.931955 234.007 0.701955C239.169 0.498955 244.191 1.50895 249.097 3.18795C256.88 5.85395 264.337 9.12595 271.404 13.417C275.808 16.089 280.133 18.696 283.58 22.601C285.338 24.591 287.455 26.2709 289.187 28.2829C296.781 37.0899 298.767 47.203 296.302 58.465C295.044 64.211 293.189 69.723 290.986 75.139C287.625 83.399 284.443 91.746 280.726 99.846C278.041 105.691 274.613 111.197 271.518 116.857ZM95.393 132.113C95.569 132.066 95.745 132.021 95.92 131.974C95.768 131.382 95.617 130.788 95.465 130.197C95.283 130.244 95.102 130.291 94.922 130.338C95.078 130.93 95.236 131.521 95.393 132.113ZM225.68 158.404C225.83 158.343 225.985 158.293 226.121 158.211C226.142 158.199 226.103 157.986 226.062 157.977C225.916 157.94 225.755 157.948 225.601 157.938C225.627 158.092 225.652 158.248 225.68 158.404Z"
		                fill="black" />
		              </svg>
		            </div>
				';
			}

		}


	}

}

// Register our new widget
Plugin::instance()->widgets_manager->register_widget_type( new Widget_TommusRhodus_Inner_Decorations_Block() );