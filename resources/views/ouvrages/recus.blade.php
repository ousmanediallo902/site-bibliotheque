<h1>Ouvrages reçus</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Éditeur</th>
                <th>Année</th>
                <th>Domaine</th>
                <th>Stock</th>
                <th>Site</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ouvrages as $ouvrage)
                <tr>
                    <td>{{ $ouvrage['titre'] ?? '' }}</td>
                    <td>{{ $ouvrage['auteur']['nom_auteur'] ?? '' }}</td>
                    <td>{{ $ouvrage['editeur'] ?? '' }}</td>
                    <td>{{ $ouvrage['annee'] ?? '' }}</td>
                    <td>{{ $ouvrage['domaine'] ?? '' }}</td>
                    <td>{{ $ouvrage['stock'] ?? '' }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

