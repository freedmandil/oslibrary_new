<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lib_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_title_id');
            $table->string('book_edition')->nullable();
            $table->text('book_notes')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->string('book_type');
            $table->unsignedBigInteger('book_topic_id');
            $table->unsignedBigInteger('book_category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('group_id');
            $table->string('book_class_ref', 3);
            $table->decimal('book_class_number', 8, 2);
            $table->unsignedBigInteger('book_reference_id');
            $table->unsignedBigInteger('language_id');
            $table->string('shelf_number');
            $table->string('book_number');
            $table->string('barcode');
            $table->unsignedBigInteger('loc_assignment_id');
            $table->dateTime('date_created');
            $table->timestamp('date_updated')->useCurrent();
            $table->unsignedBigInteger('publisher_id');
            $table->date('date_of_publication')->nullable();
            $table->string('publication_location')->nullable();
            $table->foreign('book_title_id')->references('id')->on('lib_titles');
            $table->foreign('publisher_id')->references('id')->on('lib_publishers');
            $table->foreign('author_id')->references('id')->on('lib_authors');
            $table->foreign('book_topic_id')->references('id')->on('tax_topics');
            $table->foreign('book_category_id')->references('id')->on('tax_categories');
            $table->foreign('subcategory_id')->references('id')->on('tax_subcat');
            $table->foreign('group_id')->references('id')->on('tax_group');
            $table->foreign('loc_assignment_id')->references('id')->on('loc_assignments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lib_books');
    }
};
