<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;


class ProductsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Product::all();

        //SELECT `id`, `title`, `slug`, `f_thumbnail`,
        // `short_desc`, `description`,
        // `extra_desc`, `cost_price`, `sale_price`,
        // `old_price`, `start_date`, `end_date`,
        // `is_discount`, `is_stock`, `sku`,
        // `stock_status_id`, `stock_qty`, `u_stock_qty`,
        // `category_ids`, `cat_id`, `brand_id`, `collection_id`,
        // `label_id`, `variation_color`, `variation_size`,
        // `tax_id`, `is_featured`, `is_publish`,
        // `user_id`, `lan`, `og_title`, `og_image`,
        // `og_description`, `og_keywords`,
        // `created_at`, `updated_at` FROM `products` WHERE 1
        $datalist = DB::table('products')
//            ->join('tp_status', 'products.is_publish', '=', 'tp_status.id')
//            ->join('languages', 'products.lan', '=', 'languages.language_code')
//            ->join('pro_categories', 'products.cat_id', '=', 'pro_categories.id')
//            ->leftJoin('brands', 'products.brand_id', '=', 'brands.id')
            ->select(
                'products.title',
                'products.short_desc',
                'products.sku',
                'products.f_thumbnail',
                'products.id',
                'products.id',
                'products.variation_color',
                'products.variation_size',
                'products.sale_price',
                'products.slug')
            ->where('products.cat_id',62 )
            ->orderBy('products.id','asc')
            ->take(3)
            ->get();
        foreach($datalist as $item){
            //dd($item->id);
           // $object->new_key="value";

            if (is_null($item->variation_color)){
                $item->variation_color="No colour";
            }

            $item->Product_path = 'https://eastleighsouq.com/product/'.$item->id.'/cups';
            $item->External_id='External_id'.$item->id;
            $item->Barcode='Barcode'.$item->id;
            $item->f_thumbnail='https://eastleighsouq.com/public/media/'.$item->f_thumbnail;


        }
       // dd($datalist);
            //->get()
//https://islisouq.com/public/media/07022023151503-400x400-furniture.jpeg
        return $datalist;
    }
    public function headings(): array
    {
        return ["Product Name",
            "Product Description",
            "Product SKU",
            "Product Image",
            "Product Path",
            "External ID",
            "Inventory Color",
            "Inventory Siz",
            "Retail Price",
            "Barcode"];
    }
}
