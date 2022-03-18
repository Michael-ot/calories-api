<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Traits\ApiResponser;

class FoodController extends Controller
{
    use ApiResponser;
    public function create(Request $request){
        $food = new Food();
        $food->time = $request->time;
        $food->food = $request->food;
        $food->calories = $request->calories;
        $food->user_id = auth()->user()->id;
        $food->save();


        return $this->success([
            "food" => $food,
            "owner" => auth()->user()
        ]);
    }

    public function getFoods(){
        $foods = Food::where("user_id",auth()->user()->id)->get();

        return $this->success(
            [
                "foods" => $foods
            ]
        );
    }

    public function getAllFoods(){

        $foods = Food::with(["owner"])->get();

        return $this->success(
            [
                "foods" => $foods
            ]
        );
    }

    public function deletefood(Request $request,$id){
        $food = Food::find($id);
        $food->delete();

        return $this->success(
            [
                "foodDeleted" => $id
            ]
        );
    }

    public function updateFood(Request $request,$id){
        $food = Food::where("id", $id)->with(["owner"])->first();
        $food->time = $request->time;
        $food->food = $request->food;
        $food->calories = $request->calories;
        $food->user_id = auth()->user()->id;
        $food->save();

        return $this->success([
            "food" => $food
        ]);
    }
}
