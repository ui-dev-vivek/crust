<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // $this->call([
        //     ProductTypesTableSeeder::class,
            // CategoriesTableSeeder::class,
            // ProductGroupsTableSeeder::class,
            // ProductsTableSeeder::class,
            // ProductVariantsTableSeeder::class,
            // ProductBadgesTableSeeder::class,
            // ProductImagesTableSeeder::class,
            // ProductVariantImagesTableSeeder::class,
            // ProductSeoTableSeeder::class,
            // ProductDiscountsTableSeeder::class,
            // ProductCustomFieldsTableSeeder::class,
            // ProductReviewsTableSeeder::class,
            // RelatedProductsTableSeeder::class,
            // CartItemsTableSeeder::class,
            // OrdersTableSeeder::class,
            // OrderItemsTableSeeder::class,
            // OrderCustomFieldResponsesSeeder::class,
            // AddressesTableSeeder::class,
            // PaymentsTableSeeder::class,
            // WishlistsTableSeeder::class,
            // HomeCrousalsTableSeeder::class,
            // HomePopupsTableSeeder::class,
            // OfferBannersTableSeeder::class,
        // ]);
    }
}

