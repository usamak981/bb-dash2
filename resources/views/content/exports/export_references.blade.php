<table class="reference-list-table table">
    <thead class="table-light" id="reference-export-table">
    <tr>
        <th>@lang("locale.Kategorie")</th>
        <th>@lang("locale.Objekt")</th>
        <th>@lang("locale.Straße Nr")</th>
        <th>@lang("locale.PLZ")</th>
        <th>@lang("locale.Ort")</th>
        <th>@lang("locale.Land / Fertigstellungsjahr")</th>
        <th>@lang("locale.Objekttyp")</th>
        <th>@lang("locale.Leistungskompetenz")</th>
        <th>@lang("locale.Wettkampfbecken")</th>
        <th>@lang("locale.Arge")</th>
        <th>@lang("locale.PPP")</th>
        <th>@lang("locale.Projektart")</th>
        <th>@lang("locale.Beckenanzahl")</th>
        <th>@lang("locale.max. Länge (m)")</th>
        <th>@lang("locale.max. Breite (m)")</th>
        <th>@lang("locale.Wasserfläche (m2)")</th>
        <th>@lang("locale.Tiefe (m)")</th>
        <th>@lang("locale.Material")</th>
        <th>@lang("locale.Bemerkung")</th>
    </tr>
    </thead>
    <tbody>
    @foreach($references as $reference)
        <tr>
            <td>{{ $reference->category }}</td>
            <td>{{ $reference->name }}</td>
            <td>{{ $reference->street }}</td>
            <td>{{ $reference->postal_code }}</td>
            <td>{{ $reference->city }}</td>
            <td>{{ $reference->country_code }}</td>
            <td>{{ $reference->objekt_type_code }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @foreach($reference->projekts as $projekt)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $projekt->competence }}</td>
                <td>@if($projekt->sports_pool == 1) @lang('locale.Ja') @else @lang('locale.Nein') @endif </td>
                <td>@if($projekt->bec == 1) @lang('locale.Ja') @else @lang('locale.Nein') @endif </td>
                <td>@if($projekt->ppp == 1) @lang('locale.Ja') @else @lang('locale.Nein') @endif </td>
                <td>{{ $projekt->projekt_type_code }}</td>
                <td>{{ $projekt->total_pools }}</td>
                <td>{{ $projekt->lenght }}</td>
                <td></td>
                <td>{{ $projekt->surface }}</td>
                <td>{{ $projekt->depth_max }}</td>
                <td>{{ $projekt->material }}</td>
                <td></td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
