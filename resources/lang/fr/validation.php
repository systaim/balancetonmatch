<?php

return [

    /*
    | ------------------------------------------------- -------------------------
    | Lignes de langue de validation
    | ------------------------------------------------- -------------------------
    |
    | Les lignes de langue suivantes contiennent les messages d'erreur par défaut utilisés par
    | la classe de validateur. Certaines de ces règles ont plusieurs versions telles que
    | comme les règles de taille. N'hésitez pas à modifier chacun de ces messages.
    |
    */

    'accepted' => 'Le champ: attribut doit être accepté.',
    'active_url' => "Le champ: l'attribut n'est pas une URL valide.",
    'after' => 'Le champ: attribut doit être une date postérieure au: date.',
    'after_or_equal' => 'Le champ: attribut doit être une date postérieure ou égale au: date.',
    'alpha' => 'Le champ: attribut doit contenir uniquement des lettres.',
    'alpha_dash' => 'Le champ: attribut doit contenir uniquement des lettres, des chiffres et des tirets.',
    'alpha_num' => 'Le champ: attribut doit contenir uniquement des chiffres et des lettres.',
    'array' => 'Le champ: attribut doit être un tableau.' ,
    'before' => 'Le champ: attribut doit être une date antérieure au: date.',
    'before_or_equal' => 'Le champ: attribut doit être une date antérieure ou égale au: date.',
    'between' => [
        'numeric' => 'La valeur de: attribut doit être comprise entre: min et: max.' ,
        'file' => 'La taille du fichier de: attribut doit être compris entre: min et: max kilo-octets.',
        'string' => 'Le texte: attribut doit contenir entre: min et: max caractères.',
        'array' => 'Le tableau: attribut doit contenir entre: min et: max éléments.',
        ],
    'boolean' => 'Le champ: attribut doit être vrai ou faux.',
    'confirm' => 'Le champ de confirmation: attribut ne correspond pas.',
    'date' => "Le champ: attribut n'est pas une date valide.",
    'date_equals' => 'Le champ: attribut doit être une date égale à: date.',
    'date_format' => 'Le champ: attribut ne correspond pas au format: format.',
    'different' => 'Les champs: attribut et: other doivent être différents.',
    'digits' => 'Le champ: attribut doit contenir: digits chiffres.',
    'digits_between' => 'Le champ: attribut doit contenir entre: min et: max chiffres.',
    'dimensions' => "La taille de l'image: l'attribut n'est pas conforme.",
    'distinct' => 'Le champ: attribuez une valeur en double.' ,
    'email' => 'Le champ: attribut doit être une adresse email valide.',
    'ends_with' => 'Le champ: attribut doit se terminer par une des valeurs suivantes:: values',
    'exists' => 'Le champ: attribut sélectionné est invalide.',
    'file' => 'Le champ: l\'attribut doit être un fichier.',
    'fill' => 'Le champ: attribut doit avoir une valeur.',
    'gt' => [
        'numeric' => 'La valeur de: attribut doit être supérieure à: value.',
        'file' => 'La taille du fichier de: attribut doit être supérieure à: valeur kilo-octets.',
        'string' => 'Le texte: attribut doit contenir plus de: value caractères.',
        'array' => 'Le tableau: attribut doit contenir plus de: value éléments.',
    ],
    'gte' => [
        'numeric' => 'La valeur de: attribut doit être supérieure ou égale à: value.',
        'file' => 'La taille du fichier de: attribut doit être supérieure ou égale à: valeur kilo-octets.',
        'string' => 'Le texte: attribut doit contenir au moins: value caractères.',
        'array' => 'Le tableau: attribute doit contenir au moins: value éléments.',
    ],
    'image' => 'Le champ: attribut doit être une image.',
    'in' => 'Le champ: attribut est invalide.',
    'in_array' => "Le champ: l'attribut n'existe pas dans: autre.",
    'integer' => 'Le champ: attribut doit être un entier.',
    'ip' => 'Le champ: attribut doit être une adresse IP valide.',
    'ipv4' => 'Le champ: l\'attribut doit être une adresse IPv4 valide.',
    'ipv6'  => 'Le champ: attribut doit être une adresse IPv6 valide.',
    'json' => 'Le champ: l\'attribut doit être un document JSON valide.',
    'lt' => [
        'numeric' => 'La valeur de: attribut doit être inférieure à: value.',
        'file' => 'La taille du fichier de: attribut doit être inférieure à: valeur kilo-octets.',
        'string' => 'Le texte: attribut doit contenir moins de: value caractères.',
        'array' => 'Le tableau: attribute doit contenir moins de: value éléments.',
    ],
    'lte' => [
        'numeric' => 'La valeur de: attribut doit être inférieure ou égale à: value.',
        'file' => 'La taille du fichier de: attribut doit être inférieure ou égale à: valeur kilo-octets.',
        'string' => 'Le texte: attribut doit contenir au plus: value caractères.',
        'array' => 'Le tableau: attribut doit contenir au plus: value éléments.',
    ],
    'max' => [
        'numeric' => 'La valeur de: attribut ne peut être supérieure à: max.',
        'file' => 'La taille du fichier de: attribut ne peut pas dépasser: max kilo-octets.',
        'string' => 'Le texte de: attribut ne peut contenir plus de: max caractères.',
        'array' => 'Le tableau: attribut ne peut contenir plus de: max éléments.',
    ],
    'mimes' => 'Le champ: attribut doit être un fichier de type:: values.',
    'mimetypes' => 'Le champ: attribut doit être un fichier de type:: values.',
    'min' => [
        'numeric' => 'La valeur de: attribut doit être supérieure ou égale à: min.',
        'file' => 'La taille du fichier de: attribut doit être supérieure à: min kilo-octets.',
        'string' => 'Le texte: attribut doit contenir au moins: min caractères.',
        'array' => 'Le tableau: attribute doit contenir au moins: min éléments.',
    ],
    'multiple_of' => 'La valeur de: attribute doit être un multiple de: value',
    'not_in' => "Le champ: attribut sélectionné n'est pas valide.",
    'not_regex' => "Le format du champ: l'attribut n'est pas valide.",
    'numeric' => 'Le champ: attribut doit contenir un nombre.',
    'password' => 'Le mot de passe est incorrect',
    'present' => 'Le champ: attribut doit être présent.',
    'regex' => 'Le format du champ: attribut est invalide.',
    'required' => 'Le champ: attribut est obligatoire.',
    'required_if' => 'Le champ: attribut obligatoire quand la valeur de: other est: value.',
    'required_unless' => 'Le champ: attribut est obligatoire sauf si: other est: values.',
    'required_with' => 'Le champ: attribut est obligatoire quand: values ​​is present.',
    'required_with_all' => 'Le champ: attribut obligatoire quand: values ​​are present.' ,
    'required_without' => "Le champ: l'attribut est obligatoire quand: values ​​n'est pas présent.",
    'required_without_all' => "Le champ: attribut est requis quand aucun de: values ​​n'est présent.",
    'same' => 'Les champs: attribut et: other doivent être identiques.',
    'size' => [
        'numeric' => 'La valeur de: attribut doit être: size.' ,
        'file' => 'La taille du fichier de: attribut doit être de: size kilo-octets.',
        'string' => 'Le texte de: attribut doit contenir: size caractères.',
        'array' => 'Le tableau: attribut doit contenir: size éléments.',
    ],
    'starts_with' => 'Le champ: attribut doit commencer avec une des valeurs suivantes:: values',
    'string' => 'Le champ: l\'attribut doit être une chaîne de caractères.',
    'timezone' => 'Le champ: attribut doit être un fuseau horaire valide.',
    'unique' => 'La valeur du champ: attribut est déjà utilisé.',
    'upload' => 'Le fichier du champ: l\'attribut n\'a pu être téléversé.',
    'url' => 'Le format de l\'URL de: attribut n\'est pas valide.',
    'uuid' => 'Le champ: attribut doit être un UUID valide',

    /*
    | ------------------------------------------------- -------------------------
    | Lignes de langue de validation personnalisées
    | ------------------------------------------------- -------------------------
    |
    | Ici, vous pouvez spécifier des messages de validation personnalisés pour les attributs en utilisant le
    | convention "attribut.rule" pour nommer les lignes. Cela permet de
    | spécifiez une ligne de langue personnalisée spécifique pour une règle d'attribut donnée.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'message-personnalisé',
        ],
    ],

    /*
    | ------------------------------------------------- -------------------------
    | Attributs de validation personnalisés
    | ------------------------------------------------- -------------------------
    |
    | Les lignes de langue suivantes sont utilisées pour permuter les espaces réservés d'attribut
    | avec quelque chose de plus convivial comme une adresse e-mail à la place
    | de "email". Cela nous aide simplement à rendre les messages un peu plus propres.
    |
    */

    'attributs' => [
        'name' => 'nom',
        'username' => "nom d'utilisateur",
        'email' => 'adresse email',
        'first_name' => 'prénom',
        'last_name' => 'nom',
        'password' => 'mot de passe',
        'password_confirmation' => 'confirmation du mot de passe',
        'city' => 'ville',
        'country' => 'paie',
        'address' => 'adresse',
        'phone' => 'téléphone',
        'mobile' => 'portable',
        'age' => 'âge',
        'sex' => 'sexe',
        'gender' => 'genre',
        'day' => 'jour',
        'month' => 'mois',
        'year' => 'année',
        'hour' => 'heure',
        'minute' => 'minute',
        'second' => 'seconde',
        'title' => 'titre',
        'content' => 'contenu',
        'description' => 'description',
        'excerpt' => 'extrait',
        'date' => 'date',
        'time' => 'heure',
        'available' => 'disponible',
        'size' => 'taille',
    ],
];