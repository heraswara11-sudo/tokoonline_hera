Schema::create('product', function (Blueprint $table) {
    $table->id();
    $table->string('nama_barang');
    $table->string('kode_barang')->unique();
    $table->date('tgl_masuk')->nullable();
    $table->integer('harga');
    $table->integer('quantity');
    $table->text('produk_description_short')->nullable();
    $table->text('produk_description_long')->nullable();
    $table->unsignedBigInteger('tag_id')->nullable();
    $table->timestamps();
});
