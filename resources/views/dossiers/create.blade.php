<form action="{{ route('dossiers.store')}}" method="POST">
   @csrf
    <table>
        <tr>
            <td>Libelle</td>
            <td><input type="text" name="libelle" placeholder="Libelle du dossier"></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><textarea name="description" id="" cols="30" rows="10"></textarea></td>
        </tr>
    </table>
    <button type="submit">Enregistrer</button>
</form>
