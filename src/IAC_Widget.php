<?php

class IAC_Widget extends WP_Widget
{

    /** constructor -- name this the same as the class above */
    public function __construct()
    {
        parent::__construct('iac_widget',
            esc_html__('Inform About Content', 'inform-about-content-widget'), [
                'description' => esc_html__('Widget to display user settings as widget',
                    'inform-about-content-widget')
            ]);
    }


    /** @see WP_Widget::widget -- do not rename this */
    public function widget($args, $instance)
    {
        $title         = apply_filters('widget_title', $instance['title']);
        $message       = $instance['message'];
        $user_settings = apply_filters('iac_get_user_settings', [], wp_get_current_user()->ID);

        ?>
        <?php echo $args['before_widget']; ?>
        <?php if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>
        <ul>
            <li><?php echo $message; ?></li>
        </ul>
        <form action="#">
            <input type="checkbox" id="iac_posts_checkbox" name="iac_posts_checkbox"
                   <?php echo $user_settings['inform_about_posts'] ? 'checked' : ''; ?>>
            <label for="iac_posts_checkbox">Inform about Posts</label>
            <br>
            <input type="checkbox" id="iac_comments_checkbox" name="iac_comments_checkbox"
                   <?php echo $user_settings['inform_about_comments'] ? 'checked' : ''; ?>>
            <label for="iac_comments_checkbox">Inform about Comments</label>
        </form>
        <?php echo $args['after_widget']; ?>
        <?php
    }


    /** @see WP_Widget::update -- do not rename this */
    public function update($new_instance, $old_instance)
    {
        $instance            = $old_instance;
        $instance['title']   = strip_tags($new_instance['title']);
        $instance['message'] = strip_tags($new_instance['message']);

        return $instance;
    }


    /** @see WP_Widget::form -- do not rename this */
    public function form($instance)
    {
        $title   = esc_attr($instance['title']);
        $message = esc_attr($instance['message']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo $title; ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Simple Message'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('message'); ?>"
                   name="<?php echo $this->get_field_name('message'); ?>" type="text"
                   value="<?php echo $message; ?>"/>
        </p>
        <?php
    }
} // end class example_widget
