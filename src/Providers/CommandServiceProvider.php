<?php

namespace Uitccommerce\DevTool\Providers;

use Uitccommerce\Base\Supports\ServiceProvider;
use Uitccommerce\DevTool\Commands\LocaleCreateCommand;
use Uitccommerce\DevTool\Commands\LocaleRemoveCommand;
use Uitccommerce\DevTool\Commands\Make\ControllerMakeCommand;
use Uitccommerce\DevTool\Commands\Make\FormMakeCommand;
use Uitccommerce\DevTool\Commands\Make\ModelMakeCommand;
use Uitccommerce\DevTool\Commands\Make\RepositoryMakeCommand;
use Uitccommerce\DevTool\Commands\Make\RequestMakeCommand;
use Uitccommerce\DevTool\Commands\Make\RouteMakeCommand;
use Uitccommerce\DevTool\Commands\Make\TableMakeCommand;
use Uitccommerce\DevTool\Commands\PackageCreateCommand;
use Uitccommerce\DevTool\Commands\PackageMakeCrudCommand;
use Uitccommerce\DevTool\Commands\PackageRemoveCommand;
use Uitccommerce\DevTool\Commands\PluginCreateCommand;
use Uitccommerce\DevTool\Commands\PluginMakeCrudCommand;
use Uitccommerce\DevTool\Commands\RebuildPermissionsCommand;
use Uitccommerce\DevTool\Commands\TestSendMailCommand;
use Uitccommerce\DevTool\Commands\ThemeCreateCommand;
use Uitccommerce\DevTool\Commands\WidgetCreateCommand;
use Uitccommerce\DevTool\Commands\WidgetRemoveCommand;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            TableMakeCommand::class,
            ControllerMakeCommand::class,
            RouteMakeCommand::class,
            RequestMakeCommand::class,
            FormMakeCommand::class,
            ModelMakeCommand::class,
            RepositoryMakeCommand::class,
            PackageCreateCommand::class,
            PackageMakeCrudCommand::class,
            PackageRemoveCommand::class,
            TestSendMailCommand::class,
            RebuildPermissionsCommand::class,
            LocaleRemoveCommand::class,
            LocaleCreateCommand::class,
        ]);

        if (class_exists(\Uitccommerce\PluginManagement\Providers\PluginManagementServiceProvider::class)) {
            $this->commands([
                PluginCreateCommand::class,
                PluginMakeCrudCommand::class,
            ]);
        }

        if (class_exists(\Uitccommerce\Theme\Providers\ThemeServiceProvider::class)) {
            $this->commands([
                ThemeCreateCommand::class,
            ]);
        }

        if (class_exists(\Uitccommerce\Widget\Providers\WidgetServiceProvider::class)) {
            $this->commands([
                WidgetCreateCommand::class,
                WidgetRemoveCommand::class,
            ]);
        }
    }
}
