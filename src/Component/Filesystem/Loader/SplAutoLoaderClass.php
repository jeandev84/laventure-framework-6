<?php
namespace Laventure\Component\Filesystem\Loader;

class SplAutoLoaderClass
{

      /**
       * @param NamespaceLoader $namespaceLoader
      */
      public function __construct(protected NamespaceLoader $namespaceLoader)
      {
      }


      
      /**
       * Register class
       * 
       * @return void
      */
      public function register(): void
      {
          spl_autoload_register([$this->namespaceLoader, 'loadClass']);
      }
      
      
      public function unregister(): void
      {
          
      }
}