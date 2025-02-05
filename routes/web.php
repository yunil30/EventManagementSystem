    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/', [UserController::class, 'ShowListOfUsers']);
    Route::get('/GetActiveUsers', [UserController::class, 'GetActiveUsers']);
    Route::post('/CreateUserRecord', [UserController::class, 'CreateUserRecord']);
