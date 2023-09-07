<?php

use App\Models\Category;
use App\Models\User;
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
        Schema::create('nfts', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 100);
            $table->string('artiste');
            $table->string('description', 255);
            $table->string('adresse')->unique();
            $table->enum('standard',['ERC-721', 'ERC-1155', 'ERC-998'])->default('ERC-721');
            $table->float('price');
            $table->string('file', 255);
            $table->timestamps();
            
            
                                    
        });
        
        // modification de la table NFT pour mettre les relations et les contraintes de suppressions
        
        Schema::table('nfts', function(Blueprint $table){
            
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
        
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nfts');
        
        Schema::table('nfts', function(Blueprint $table){
            $table->dropConstrainedForeignIdFor(User::class);
            $table->dropConstrainedForeignIdFor(Category::class);
        });
    }
};
