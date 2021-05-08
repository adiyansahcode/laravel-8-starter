@props([
    'id',
    'label' => 'label',
    'checked' => false
])

<div class="flex items-center">
    <input
        {{ $checked ? "checked='checked'" : '' }}
        {{
            $attributes->merge([
                'class' => 'h-4 w-4 focus:ring-gray-500 text-gray-600 border-gray-400',
                'type' => 'radio',
                'id' => $id,
            ])
        }}
    />
    <label
        {{
            $attributes->merge(['
                class' => 'ml-3 block font-medium text-sm text-gray-700 capitalize',
                'for' => $id,
            ])
        }}
    >
        {{ $label }}
    </label>
</div>
