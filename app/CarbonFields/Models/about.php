<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'post_meta', __( 'Section Options', 'crb' ) )
    ->where( 'post_type', '=', 'page' )
    ->where( 'post_template', '=', 'template-about.php' )
    ->add_fields(array(
        Field::make('rich_text', 'new_short_text', 'Описание на главной')
));