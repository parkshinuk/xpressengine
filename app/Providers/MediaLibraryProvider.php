<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Xpressengine\MediaLibrary\MediaLibraryHandler;
use Xpressengine\MediaLibrary\Models\MediaLibraryFile;
use Xpressengine\MediaLibrary\Models\MediaLibraryFolder;
use Xpressengine\MediaLibrary\Repositories\MediaLibraryFileRepository;
use Xpressengine\MediaLibrary\Repositories\MediaLibraryFolderRepository;

class MediaLibraryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setModels();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindClasses();

        $this->registerRepositories();
    }

    private function bindClasses()
    {
        $this->app->singleton(MediaLibraryHandler::class, function () {
            return new MediaLibraryHandler;
        });
        $this->app->alias(MediaLibraryHandler::class, 'xe.media_library');
    }

    private function setModels()
    {
        MediaLibraryFileRepository::setModel(MediaLibraryFile::class);
        MediaLibraryFolderRepository::setModel(MediaLibraryFolder::class);
    }

    private function registerRepositories()
    {
        $this->app->singleton(MediaLibraryFileRepository::class, function () {
            return new MediaLibraryFileRepository;
        });
        $this->app->alias(MediaLibraryFileRepository::class, 'xe.media_library.files');

        $this->app->singleton(MediaLibraryFolderRepository::class, function () {
            return new MediaLibraryFolderRepository;
        });
        $this->app->alias(MediaLibraryFolderRepository::class, 'xe.media_library.folders');
    }
}
