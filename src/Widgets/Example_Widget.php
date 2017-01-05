<?php

namespace Plugin\Widgets;

use WP_Widget;


class Example_Widget extends WP_Widget
{
    public function __construct()
    {
        $id = 'example_widget';
        $name = esc_html__( 'Title', 'text_domain' );
        $options = [
            'description' => esc_html__( 'An Example Widget', 'text_domain' ),
        ];

        parent::__construct($id, $name, $options);
    }

    /**
     * @param array $args
     * @param array $instance
     *
     * @author Xavier Sanna
     */
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        echo esc_html__( 'Hello, World!', 'text_domain' );
        echo $args['after_widget'];
    }

    /**
     * @param array $instance
     *
     * @return string|void
     */
    public function form($instance) {
        $title =  ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
        $title_field_id = esc_attr($this->get_field_id('title'));
        $title_field_name = esc_attr( $this->get_field_name( 'title' ));

        $form = '<p>
        <label for="' . $title_field_id . '">' . esc_attr_e( "Title:", "text_domain" ) . '</label>
        <input class="widefat" id="' . $title_field_id . '" name="' . $title_field_name . '" type="text" value="' . $title .'">
        </p>';

        echo $form;
    }

    /**
     * @param array $newInstance
     * @param array $oldInstance
     * @return mixed
     *
     * @author Xavier Sanna
     */
    public function update($newInstance, $oldInstance)
    {
        $instance = $oldInstance;
        $instance['title'] = ( ! empty( $newInstance['title'] ) ) ? strip_tags( $newInstance['title'] ) : '';
        return $instance;
    }
}