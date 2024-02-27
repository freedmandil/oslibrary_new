<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB; // Assuming use of Laravel's database facade

class MigrateBooksData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-books-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate books from old structure to new structure';


    protected function processAuthor($authorName)
    {
        // Parse author name according to specified rules and create or find in `lib_authors`
        // Return the author ID
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oldBooks = DB::connection('thefr622_oslibold2')->table('tbl-oldbks')->get();
        $i = 0;
        foreach ($oldBooks as $oldBook) {
            $i++;

            $bookTitle = trim($oldBook->name); // Assuming this is the title from your old book record
            $bookLanguage = detectLanguage($bookTitle);

            $titleRecord = \App\Models\LibTitle::firstOrCreate([
                'book_title' => $oldBook->name, // Searching for this title
                'book_subtitle' => $oldBook->mascht, // And this subtitle
            ]);
            $bookTitleId = $titleRecord->id;

            $shelfComponents = parseShelfNumber($oldBook->shelfno);

// Attempt to find an existing shelf name with the same components
            $existingShelf = \App\Models\LocShelfname::where([
                ['prefix', '=', $shelfComponents['prefix']],
                ['number', '=', $shelfComponents['number']],
                ['suffix', '=', $shelfComponents['suffix']],
            ])->first();

            if ($existingShelf) {
                // If found, use the existing record's ID
                $bookShelfnameId = trim($existingShelf->id);
            } else {
                // If not found, create a new record and use its ID
                $newShelf = \App\Models\LocShelfname::create([
                    'name' => $oldBook->shelfno,
                    'prefix' => $shelfComponents['prefix'],
                    'number' => $shelfComponents['number'],
                    'suffix' => $shelfComponents['suffix'],
                ]);
                $bookShelfnameId = $newShelf->id;
            }
            if (!empty($oldBook->mah)) {
                    $bookPublisherId = ($bookLanguage = 'he') ? \App\Models\LibPublisher::firstOrCreate(['name_he' => $oldBook->mah])->id : \App\Models\LibPublisher::firstOrCreate(['name_en' => $oldBook->mah])->id;
            } else {
                $bookPublisherId = 1;
            }
            // Parse and process data here...
            // For example, parsing author names and creating or finding authors in the new table
            $oldBookAuthorName = trim($oldBook->auth); // Assuming $oldBook->auth contains the author's name

            // Parse the author's name

            $authorComponents = !empty(parseAuthorName($oldBookAuthorName)) ? parseAuthorName($oldBookAuthorName) : null;
            if (!empty($authorComponents)) {

                $author = \App\Models\LibAuthor::firstOrCreate(
                    [
                        'last_name' => $authorComponents['last_name'],
                        'first_name' => $authorComponents['first_name'],
                    ],
                    $authorComponents
                );

                $authorId = $author->id;
            } else {
                $authorId = null;
            }

            switch ($bookLanguage) {
                case 'en': $bookLanguageId = 41;
                default:
                case 'he': $bookLanguageId = 59;
            }

            $Barcode = create_barcode_number($oldBook->seferno, $oldBook->shelfno);

            $locAssignmentId = determineLocAssignmentId($oldBook->shelfno);
            $Booknotes = $oldBook->nts;
            $BookReference_id = $oldBook->bkref;
            $BookTyoe = $oldBook->type;
            $BookTopic_id = $oldBook->tpcid;
            $BookCatId = empty($oldBook->catid) ? null : intval($oldBook->catid);

            // Create or find other necessary records (publishers, titles, etc.)
            // Insert new book record
            $newBook = new \App\Models\LibBook([
                'book_title_id' => $bookTitleId,
                'book_edition' => $oldBook->mah,
                'book_notes' => $Booknotes,
                'book_type' => $BookTyoe,
                'book_topic_id' => $BookTopic_id,
                'book_category_id' => $BookCatId,
                'subcategory_id' => null,
                'group_id' => null,
                'book_class_ref' => null,
                'book_class_number' => null,
                'book_reference_id' => $BookReference_id,
                'language_id' => $bookLanguageId,
                'shelf_number_id' => $bookShelfnameId,
                'sefer_number' => intval($oldBook->seferno),
                'barcode' => $Barcode,
                'loc_assignment_id' => $locAssignmentId,
                'publisher_id' => $bookPublisherId,
                'date_of_publication' => null,
                'publication_location' => null,
            ]);
            $this->info(var_export($oldBook,true));
            $this->info(var_export($newBook,true));


            $newBook->save();
            if ($i = 1) {
                break;
            }
            // Output progress or confirmation
            $this->info("Migrated book: {$oldBook->name}");
        }    }
}
