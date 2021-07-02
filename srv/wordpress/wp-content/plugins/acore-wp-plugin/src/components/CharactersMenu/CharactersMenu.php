<?php

namespace ACore;

require_once "Characters.controller.php";

add_action('init', __NAMESPACE__ . '\\characters_menu_init');

class CharactersMenu
{
    private static $instance = null;

    /**
     * Singleton
     * @return CharactersMenu
     */
    public static function I()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function acore_characters_menu()
    {
        add_submenu_page('profile.php', 'Characters', 'Characters', 'subscriber', 'acore-characters-menu', array($this, 'acore_characters_menu_page'));
        wp_enqueue_script('jquery-ui-sortable');
    }

    function acore_characters_menu_page()
    {
        $controller = new CharactersController();
        $controller->loadHome();
    }
}

function characters_menu_init()
{
    $charactersMenu = CharactersMenu::I();

    add_action('admin_menu', array($charactersMenu, 'acore_characters_menu'));
}
