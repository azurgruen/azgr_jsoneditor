<?php

namespace Azurgruen\AzgrJsoneditor\Controller;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Resource\ResourceFactory;
//use \TYPO3\CMS\Core\Resource\Folder;
//use \TYPO3\CMS\Core\Resource\File;

/**
 * Class BackendController
 *
 */
class BackendController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {
    
        
    /**
     * @var \TYPO3\CMS\Core\Resource\Folder
     */
    protected $folder;
    
    /**
     * @var array
     */
    protected $files;
    
    /**
     * @var array
     */
    protected $languages;
 
    protected function initializeAction() {
	    
	    $configuration = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['azgr_jsoneditor'];
	    if (is_string($configuration)) {
			$configuration = @unserialize($configuration);
		}
		

		if ($configuration['filePath'] && @is_dir(PATH_site . $configuration['filePath'])) {
			$allowedExt = explode(',', $configuration['fileExt']);
			//$this->files = GeneralUtility::getFilesInDir(PATH_site . $configuration['filePath']);
			$resourceFactory = ResourceFactory::getInstance();
			$storage = $resourceFactory->getStorageObject(0);
			$this->folder = $storage->getFolder($configuration['filePath']);
			$this->files = $this->folder->getFiles();
			foreach ($this->files as $key => $file) {
				if (in_array($file->getExtension(), $allowedExt)) {
					$this->languages[] = $file->getNameWithoutExtension();
				} else {
					unset($this->files[$key]);
				}
			}
		}
		//\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->languages);
    }
 
    /**
     * action index
     *
     * @return void
     */
    public function indexAction() {
        //$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
        //$langRepository = $objectManager->get(\Azurgruen\AzgrJsonfiler\Domain\Repository\LangRepository::class);
        
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this);
         
        $this->view->assignMultiple([
        	'languages' => $this->languages,
        	'files' => $this->files
        ]);
    }
    
    /**
     * action show
     *
     * @param string $file
     * @param boolean $updated
     * @dontvalidate $updated
     * @return void
     */
    public function showAction($file, $updated = false) {
		
		$file = $this->files[$file];
		$filename = $file->getName();
		$language = $file->getNameWithoutExtension();
		$json = $file->getContents();
		
		if ($updated) {
			$this->addFlashMessage('File has been saved');
		}
		
		$this->view->assignMultiple([
			'languages' => $this->languages,
			'files' => $this->files,
			'language' => $language,
			'filename' => $filename,
			'json' => $json
		]);
    }
    
    /**
     * action update
     *
     * @param string $file
     * @return void
     */
    public function updateAction($file) {
		
		$file = $this->files[$file];
		$filename = $file->getName();
		$language = $file->getNameWithoutExtension();
		$backupFile = $file->copyTo($this->folder, $filename.'.backup');
		$jsondata = $this->request->getArgument('jsondata');
		
		$file = $file->setContents($jsondata);
		
		$this->redirect('show', null, null, ['file' => $filename, 'updated' => true]);
		
    }
}