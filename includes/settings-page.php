<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {

	Container::make( 'theme_options', 'Пульт' )
			 ->add_fields(array(
			 Field::make('header_scripts', 'crb_header_script'),
			 Field::make('footer_scripts', 'crb_footer_script'),
		 	))
			 ->add_tab( 'Наша команда', array(
				 Field::make( 'complex', 'crb_places', 'Список' )
					  ->add_fields( array(
						  Field::make( 'image', 'photo', 'Фото' )->set_value_type( 'url' )->set_width( 33 ),
						  Field::make( 'text', 'job', 'Должность' )->set_width( 33 ),
						  Field::make( 'text', 'fio', 'Фамилия, имя и отчество' )->set_width( 33 )
					  ) )
			 ) )
			 ->add_tab( 'Контакты', array(
				 Field::make( 'text', 'url_fb', 'Фейсбук' ),
				 Field::make( 'text', 'url_vk', 'вКонтакте' ),
				 Field::make( 'text', 'url_tw', 'Твиттер' ),
				 Field::make( "map", "crb_company_location", "Местоположение" )
					  ->help_text( 'Перетащите указатель на карту, чтобы выбрать местоположение' ),
			 ) )
			 ->add_tab( 'СЕО', array(
				 Field::make( 'text', 'title-lp', 'Title лендинга' ),
				 Field::make( 'text', 'description-lp', 'Description лендинга' ),
				 Field::make( "header_scripts", "header_google_analytics", 'Код счётчика Гугл.Аналитикс' ),
				 Field::make( "header_scripts", "header_script_yandex_metrika", 'Код счётчика Яндекс.Метрики' ),
			 ) );
		 
}