<?php

namespace phplist\FourLinux\Functionality\Interfaces\Controllers\Site;

use phplist\FourLinux\Functionality\Interfaces\Shared\AbstractController;

/**
 * Class IndexController
 *
 * @package phplist\FourLinux\Functionality\Interfaces\Controllers\Site
 */
class IndexController extends AbstractController
{
    public function __invoke()
    {
        /** @var \phplistFourLinuxFunctionality $plugin */
        $plugin = $GLOBALS['plugins'][$_GET['pi']];

        echo $this->render('site/index', [
            'pluginName' => $plugin->name(),
            'pluginDescription' => $plugin->description,
            'pluginVersion' => $plugin->getVersion(),
        ]);
    }
}
