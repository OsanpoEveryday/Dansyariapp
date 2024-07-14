
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateItemsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("items", function (Blueprint $table) {

						$table->increments('id');
						$table->string('name');
						$table->bigInteger('category_id')->unsigned();
                        $table->bigInteger('user_id')->unsigned();
						$table->string('image_path')->nullable();
						$table->integer('number')->nullable();
						$table->integer('amount')->nullable();
						$table->string('place')->nullable();
						$table->string('purchase_from')->nullable();
                        $table->date('purchase_date')->nullable();
						$table->timestamps();
						$table->boolean('want')->default(false);
						$table->boolean('is_unnecessary')->default(false);
						$table->integer('disuse_month')->nullable();
                        $table->text('url')->nullable();
                        $table->text('memo')->nullable();

						$table->foreign("category_id")->references("id")->on("categories")->onDelete('cascade');
						$table->foreign("user_id")->references("id")->on("users")->onDelete('cascade');

						// ----------------------------------------------------
						// -- SELECT [items]--
						// ----------------------------------------------------
						// $query = DB::table("items")
						// ->leftJoin("categories","categories.id", "=", "items.category_id")
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
                Schema::dropIfExists("items");
            }
        }
    