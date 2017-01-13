<?php

/*
 * Copyright (c) Sajflow 2016.
 * please see the LICENSE.md file for license information
 * 
 */

namespace tecsin\filemanager\elFinder;

/**
 * Extended cached storage adapter class for cache enabled of hasDir() method
 *
 * @author Samuel Onyijne <samuel@sajflow.com>
 */
class CachedStorageAdapter extends \League\Flysystem\Cached\Storage\Adapter {
    use \Hypweb\Flysystem\Cached\Extra\Hasdir;
    use \Hypweb\Flysystem\Cached\Extra\DisableEnsureParentDirectories;
}
