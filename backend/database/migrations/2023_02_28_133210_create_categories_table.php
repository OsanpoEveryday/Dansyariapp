
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateCategoriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("categories", function (Blueprint $table) {
						$table->bigIncrements('id');
						$table->string('name')->nullable();
						$table->timestamps();
                        $table->text('memo')->nullable();
                        $table->text('rule2')->nullable();
                        $table->text('rule1')->nullable();
                        $table->text('rule3')->nullable();
                        $table->text('rule4')->nullable();
                        $table->text('rule5')->nullable();
						$table->bigInteger('user_id')->unsigned();
                    //*********************************
                    // Foreign KEY [ Uncomment if you want to use!! ]
                    //*********************************
                        $table->foreign("user_id")->references("id")->on("users");

						// ----------------------------------------------------
						// -- SELECT [categories]--
						// ----------------------------------------------------
						// $query = DB::table("categories")
						// ->leftJoin("users","users.id", "=", "categories.user_id")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("categories");
            }
        }
    