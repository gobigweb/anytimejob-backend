<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;

class PermissionTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [];
        foreach (\Route::getRoutes()->getRoutes() as $route){
            if(is_array($route->action['middleware'])){
                if(in_array('UserPermission',$route->action['middleware'])){
                    $routeUrl = url($route->uri());
                    $routeUrl = str_replace(url('api'),'',$routeUrl);
                    $routeName = $route->getName();
                    $item = array(
                        'name' => $routeName,
                        'url' => $routeUrl,
                    );
                    $routes[] = $item;
                }
            };
        }

        //Remove Duplicate
        $routeList = array();
        $usedFruits = array();
        foreach ( $routes AS $key => $line ) {
            if ( !in_array($line['name'], $usedFruits) ) {
                $usedFruits[] = $line['name'];
                $routeList[$key] = $line;
            }
        }

        DB::table('permissions')->insert($routeList);
    }
}
