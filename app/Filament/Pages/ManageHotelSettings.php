<?php

namespace App\Filament\Pages;

use App\Models\HotelSettings;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class ManageHotelSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?string $title = 'Hotel Settings';

    protected static ?string $navigationLabel = 'Hotel Settings';

    protected static string $view = 'filament.pages.manage-hotel-settings';

    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $settings = HotelSettings::first();
        $this->form->fill($settings->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Information')
                    ->schema([
                        TextInput::make('hotel_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                    ]),

                Section::make('Social Media Links')
                    ->schema([
                        TextInput::make('facebook_url')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('instagram_url')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('twitter_url')
                            ->url()
                            ->maxLength(255),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $settings = HotelSettings::first();
        $settings->update($this->form->getState());

        Notification::make()
            ->success()
            ->title('Settings saved successfully')
            ->send();
    }
} 