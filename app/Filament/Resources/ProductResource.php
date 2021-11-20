<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Columns\Column;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class ProductResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\Fieldset::make(
                    'Label',
                    [
                        Components\TextInput::make('name'),
                        Components\TextArea::make('description'),
                        Components\FileUpload::make('image'),
                        Components\DatePicker::make('created_at'),
                        Components\DatePicker::make('updated_at'),
                    ],
                )->columns(3),

            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('name')->primary(),
                Columns\Image::make('image'),
                //Columns\Column::make('category.name'),
                Columns\Text::make('description')->limit('20'),
                Columns\Text::make('category_id'),
                Columns\Text::make('created_at')->date('d.m.Y'),
                Columns\Text::make('updated_at')->date('d.m.Y')
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListProducts::routeTo('/', 'index'),
            Pages\CreateProduct::routeTo('/create', 'create'),
            Pages\EditProduct::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
