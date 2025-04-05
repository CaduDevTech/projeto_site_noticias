# Guia de Commits - Projeto Blog em PHP

## Objetivo

Este documento define um padrão claro e consistente para mensagens de commit no repositório do Blog. O uso correto facilita:

- Leitura e compreensão do histórico de alterações;
- Geração automática de changelogs;
- Controle de versão (semver);
- Revisões de código mais eficientes.

---

## Estrutura da Mensagem de Commit

```
<tipo>(<escopo>): <mensagem breve no imperativo>
```

**Exemplo real:**
```
fix(posts): Corrige validação de cadastro para exibir erro em posts sem salvar arquivo de imagem no banco
```

---

## Tipos de Commit

| Tipo       | Uso                                                                   |
|------------|-----------------------------------------------------------------------|
| `feat`     | Quando uma nova funcionalidade é adicionada                           |
| `fix`      | Correção de bugs                                                      |
| `docs`     | Alterações apenas na documentação                                     |
| `style`    | Mudanças visuais ou de formatação (sem alteração de lógica)           |
| `refactor` | Refatoramento sem alteração de funcionalidade                         |
| `test`     | Adição ou modificação de testes                                       |
| `chore`    | Tarefas de manutenção (ex: scripts, configs, dependências)            |
| `perf`     | Melhoria de performance                                               |
| `ci`       | Mudanças em processos de CI (Integração Contínua)                     |
| `build`    | Mudanças no processo de build ou dependências                         |

---

## Escopos

O escopo define **onde** a alteração foi feita no projeto — normalmente é o nome de um **módulo**, **funcionalidade** ou **pasta** relevante.

### Idioma do Escopo

Se o projeto estiver todo em **português**, como este blog , o escopo também deve estar em **português**.

✅ Use escopos em **português** para manter consistência:
```
fix(posts): Corrige erro no cadastro de postagens
feat(comentarios): Adiciona sistema de respostas
```

❌ Evite misturar idiomas(somente caso seja muito necessário):
```
fix(posts): Fix bug na página de postagens     (Mistura de idiomas)
feat(comments): Adiciona comentários            (Escopo em inglês)
```

### Regras para uso do escopo

- Utilize **nomes reais** de módulos, funcionalidades ou pastas.
- Use **minúsculas** e **sem espaços** (use `-` se necessário).
- Não use termos genéricos como "coisas", "ajustes", "sistema".
- O escopo é **opcional**, mas **altamente recomendado** para clareza.
- Deve ser **curto e objetivo**.

### Exemplos de escopos válidos

- `posts`
- `auth`
- `comentarios`
- `cadastro`
- `database`
- `notificacoes`
- `ui`
- `api`

### Exemplos de escopos inválidos

- `coisas`
- `geral`
- `ajustes`
- `pagina-daquela-coisa`
- `outros`

---

## Boas Práticas

- Utilize **imperativo** na mensagem: ex: "Corrige", "Adiciona", "Remove".
- Mensagens devem ser **curtas e claras**.
- Commits devem ser **frequentes e pequenos**.
- Use **português** se o projeto está todo em PT-BR (como neste caso).
- **Mantenha o escopo sempre coerente** com a estrutura real do projeto.

---

## Exemplos Válidos

```
feat(auth): Adiciona autenticação com token JWT
fix(posts): Corrige bug na exibição de imagens quebradas
docs(readme): Atualiza instruções de instalação
refactor(database): Refatora conexões para usar PDO
style(ui): Ajusta espaçamento entre cards
test(auth): Adiciona testes para login inválido
chore(deps): Atualiza dependências do composer
```

---

## ❌ Exemplos Inválidos

```
commit teste
up
arrumei o bug
melhorias gerais
fix: deu ruim e arrumei
chore(coisas): mudança aleatória
```

