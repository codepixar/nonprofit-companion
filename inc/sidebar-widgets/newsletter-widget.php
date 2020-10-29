<?php
/**
 * @version  1.0
 * @package  Repair
 *
 */
 
 
/**************************************
*Creating Newsletter Widget
***************************************/
 
class Nonprofit_newsletter_widget extends WP_Widget {


    function __construct() {

        parent::__construct(
        // Base ID of your widget
        'nonprofit_newsletter',


        // Widget name will appear in UI
        esc_html__( '[ Nonprofit ] Newsletter Form', 'nonprofit-companion' ),

        // Widget description
        array( 'description' => esc_html__( 'Add footer newsletter signup form.', 'nonprofit-companion' ), )
        );

    }

    // This is where the action happens
    public function widget( $args, $instance ) {
        
    $title 		= apply_filters( 'widget_title', $instance['title'] );
    $actionurl 	= apply_filters( 'widget_actionurl', $instance['actionurl'] );
    $desc 		= apply_filters( 'widget_desc', $instance['desc'] );

    // before and after widget arguments are defined by themes
    echo wp_kses_post( $args['before_widget'] );
    if ( ! empty( $title ) )
    echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
	    ?>
        <div class="form-wrap" id="mc_embed_signup">
            <form target="_blank" action="<?php echo esc_url( $actionurl ); ?>" method="post" class="nonprofit_mailchimp_newsletter_widget">

                <div class="subscribe_form input-group align-items-center">
                    <input class="form-control" name="EMAIL" placeholder="<?php esc_html_e( 'Your Email Address', 'nonprofit-companion' ); ?>" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '" required="" type="email">

                    <div class="subscribe_btn input-group-append">
                        <button class="btn_1 btn-default text-uppercase email_icon newsletter-submit button-contactForm" type="submit"><i class="fa fa-paper-plane"></i></button>
                    </div>
                    
                    <div style="position: absolute; left: -5000px;">
                        <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                    </div>
                </div>

                <?php
                    if( $desc ){
                        echo '<p class="newsletter_text offer_text">'.esc_html( $desc ).'</p>';
                    } 
                ?>

                <div class="info"></div>
            </form>
        </div>

    <?php
    echo wp_kses_post( $args['after_widget'] );
    }
		
    // Widget Backend 
    public function form( $instance ) {
        
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = esc_html__( 'Newsletter', 'nonprofit-companion' );
        }


        //	Action Url
        if ( isset( $instance[ 'actionurl' ] ) ) {
            $actionurl = $instance[ 'actionurl' ];
        }else {
            $actionurl = 'https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&id=92a4423d01';
        }

        //	Text Area
        if ( isset( $instance[ 'desc' ] ) ) {
            $desc = $instance[ 'desc' ];
        }else {
            $desc = esc_html__( 'Subscribe newsletter to get all updates about discount and offers.', 'nonprofit-companion' );;
        }


        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:' ,'nonprofit-companion'); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'actionurl' ) ); ?>"><?php esc_html_e( 'Action URL:' ,'nonprofit-companion'); ?></label>
            <p class="description"><?php esc_html_e( 'Enter here your MailChimp action URL.' ,'nonprofit-companion'); ?> </p>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'actionurl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'actionurl' ) ); ?>" type="text" value="<?php echo esc_attr( $actionurl ); ?>" />

        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php esc_html_e( 'Short Description:' ,'nonprofit-companion'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>"><?php echo esc_textarea( $desc ); ?></textarea>
        </p>

    <?php 
    }

	
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {

        $instance = array();
        $instance['title'] 	  = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['actionurl'] = ( ! empty( $new_instance['actionurl'] ) ) ? strip_tags( $new_instance['actionurl'] ) : '';
        $instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? strip_tags( $new_instance['desc'] ) : '';

        return $instance;

    }

} // Class nonprofit_newsletter_widget ends here


// Register and load the widget
function nonprofit_newsletter_load_widget() {
	register_widget( 'Nonprofit_newsletter_widget' );
}
add_action( 'widgets_init', 'nonprofit_newsletter_load_widget' );