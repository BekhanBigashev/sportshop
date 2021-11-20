<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class CategoryResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\Fieldset::make(
                    'Категории',
                    [
                        Components\TextInput::make('name'),
                        Components\TextArea::make('description'),
                        Components\TextArea::make('code'),
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
            Pages\ListCategories::routeTo('/', 'index'),
            Pages\CreateCategory::routeTo('/create', 'create'),
            Pages\EditCategory::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
