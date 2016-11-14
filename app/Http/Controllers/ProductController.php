<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\EditProductRequest;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use App\Repositories\TypeRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProductController extends Controller
{

    protected $productRepository;
    protected $typeRepository;
    protected $stockRepository;

    public function __construct(ProductRepository $productRepository, TypeRepository $typeRepository, StockRepository $stockRepository)
    {
        $this->productRepository = $productRepository;
        $this->typeRepository = $typeRepository;
        $this->stockRepository = $stockRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = $this->typeRepository->all();
        $stock = $this->stockRepository->all();
        return view('products.create', compact('types', 'stock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->only('name', 'description', 'price', 'type_id', 'stock_id');
        if($this->productRepository->create($input)) {
            return redirect()->route('products.index');
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);
//        return view('', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $types = $this->typeRepository->all();
        $stock = $this->stockRepository->all();

        return view('products.edit', compact('product', 'types', 'stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, $id)
    {
        $input = $request->only('name', 'description', 'price', 'type_id', 'stock_id');

        if($this->productRepository->update($input, $id)) {
            return redirect()->route('products.index');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->productRepository->delete($id)){
            return redirect()->route('products.index');
        }
        return redirect()->back();
    }
}
