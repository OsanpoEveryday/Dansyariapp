
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateItemUsageHistoriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("item_usage_histories", function (Blueprint $table) {

						$table->increments('id');
						$table->integer('item_id')->nullable()->unsigned();
						$table->timestamp('use_at')->nullable();
                        $table->timestamps();
						$table->foreign("item_id")->references("id")->on("items")->onDelete('cascade');

						// ----------------------------------------------------
						// -- SELECT [item_usage_histories]--
						// ----------------------------------------------------
						// $query = DB::table("item_usage_histories")
						// ->leftJoin("items","items.id", "=", "item_usage_histories.item_id")
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
                Schema::dropIfExists("item_usage_histories");
            }
        }
    