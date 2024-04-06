
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateRulesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("rules", function (Blueprint $table) {

						$table->increments('id');
						$table->bigInteger('category_id')->unsigned();
						$table->string('text')->nullable();
						$table->timestamps();
						$table->foreign("category_id")->references("id")->on("categories");



						// ----------------------------------------------------
						// -- SELECT [rules]--
						// ----------------------------------------------------
						// $query = DB::table("rules")
						// ->leftJoin("categories","categories.id", "=", "rules.category_id")
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
                Schema::dropIfExists("rules");
            }
        }
    