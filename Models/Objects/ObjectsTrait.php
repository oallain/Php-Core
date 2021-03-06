<?php
/**
 * This file is part of SplashSync Project.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 *  @author    Splash Sync <www.splashsync.com>
 *  @copyright 2015-2017 Splash Sync
 *  @license   GNU GENERAL PUBLIC LICENSE Version 3, 29 June 2007
 * 
 **/

namespace   Splash\Models\Objects;

/**
 * @abstract    This class implements access to Objects Links Fields Helper.
 */
trait ObjectsTrait
{
    /**
     * @var Static Class Storage
     */
    private static    $ObjectsHelper;
    
    /**
     *      @abstract   Get a singleton Objects Helper Class
     * 
     *      @return     ObjectsHelper
     */    
    public static function Objects()
    {
        // Helper Class Exists
        if (isset(self::$ObjectsHelper)) {
            return self::$ObjectsHelper;
        }
        // Initialize Class
        self::$ObjectsHelper        = new ObjectsHelper();  
        // Return Helper Class
        return self::$ObjectsHelper;
    }  
}

/**
 * @abstract    Helper for Objects Fields Management
 */
class ObjectsHelper
{
   
    /**
     *      @abstract   Create an Object Identifier String
     * 
     *      @param      string      $ObjectType     Object Type Name. 
     *      @param      string      $Identifier     Object Identifier
     * 
     *      @return     string      
     */
    public static function Encode($ObjectType,$Identifier)
    {
        //====================================================================//
        // Safety Checks
        if (empty($ObjectType))                 {   return False;     }
        if (empty($Identifier))                 {   return False;     }
        
        //====================================================================//
        // Create & Return Field Id Data String
        return   $Identifier . IDSPLIT . $ObjectType; 
    }    
    
    /**
     *      @abstract   Decode an Object Identifier String
     * 
     *      @param      string      $ObjectId           Object Identifier String. 
     * 
     *      @return     string
     */
    private static function Decode($ObjectId)
    {
        // Safety Checks
        if (empty($ObjectId)) {   
            return False;     
        }
        // Explode Object String
        $Result = explode ( IDSPLIT , $ObjectId);
        // Check result is Valid
        if (count($Result) != 2) {   
            return False;     
        }
        // Return Object Array
        return   $Result; 
    }  
    
    /**
     *      @abstract   Retrieve Identifier from an Object Identifier String
     * 
     *      @param      string      $ObjectId           Object Identifier String. 
     * 
     *      @return     string
     */
    public static function Id($ObjectId)
    {
        //====================================================================//
        // Decode
        $Result     = self::Decode($ObjectId);
        if (empty($Result))                 {   
            return False;     
        }
        //====================================================================//
        // Return Object Identifier
        return   $Result[0]; 
    }     

    /**
     *      @abstract   Retrieve Object Type Name from an Object Identifier String
     * 
     *      @param      string      $ObjectId           Object Identifier String. 
     * 
     *      @return     string
     */
    public static function Type($ObjectId)
    {
        //====================================================================//
        // Decode
        $Result     = self::Decode($ObjectId);
        if (empty($Result))                 {   
            return False;     
        }
        //====================================================================//
        // Return Object Type Name
        return   $Result[1]; 

    }     
}

?>