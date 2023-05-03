<?php

namespace bushart\productmanagement;
use Illuminate\Support\ServiceProvider;

class ProductManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Grid', function() {
            return new Grid();
        });

        $this->app->bind('GridDSN', function() {
            return new GridDSN();
        });

        $this->app->bind('CrudHelpers', function() {
            return new CrudHelpers();
        });

        $this->commands([
            productmanagement\Commands\CrudCommand::class,
            productmanagement\Commands\ControllerCommand::class,
            productmanagement\Commands\ViewCommand::class,
            productmanagement\Commands\RouteCommand::class,
            productmanagement\Commands\ModelCommand::class,
            productmanagement\Commands\ViewPartialCommand::class,
            productmanagement\Commands\RequestCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/magic.php' => config_path('productmanagement.php'),
        ],'config');
        $this->publishes([
            __DIR__ . '/js/assets' => public_path('assets'),
            __DIR__ . '/js/magic.js' => public_path('js/magic.js'),
        ],'public');
        $this->publishes([
            __DIR__ . '/migration/2023_01_27_100844_create_product_categories_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_product_categories_table.php'),
            __DIR__ . '/migration/2023_01_28_065328_create_product_sub_categories_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_product_sub_categories_table.php'),
            __DIR__ . '/migration/2023_01_28_111206_create_brands_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_brands_table.php'),
            __DIR__ . '/migration/2023_01_28_112939_create_materials_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_materials_table.php'),
            __DIR__ . '/migration/2023_01_28_115636_create_styles_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_styles_table.php'),
            __DIR__ . '/migration/2023_01_30_123306_create_product_listings_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_product_listings_table.php'),
            __DIR__ . '/migration/2023_02_21_080359_create_colors_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_colors_table.php'),
            __DIR__ . '/migration/2023_03_07_063529_create_product_types_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_product_types_table.php'),
            __DIR__ . '/migration/2023_03_08_122400_create_product_attachments_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_product_attachments_table.php'),
            // you can add any number of migrations here
        ], 'migrations');
        require_once __DIR__ . '/productmanagement/Helpers/Grid.php';
        require_once __DIR__ . '/productmanagement/Helpers/GridDSN.php';
        require_once __DIR__ . '/productmanagement/Helpers/CrudHelpers.php';

        $this->loadViewsFrom(__DIR__.'/resources/views', 'productmanagement');

    }
}
