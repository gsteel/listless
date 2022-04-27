# Listless Contracts and Common Values

[![Build Status](https://github.com/list-interop/listless/workflows/Continuous%20Integration/badge.svg)](https://github.com/list-interop/listless/actions?query=workflow%3A"Continuous+Integration")

[![codecov](https://codecov.io/gh/list-interop/listless/branch/main/graph/badge.svg)](https://codecov.io/gh/list-interop/listless)
[![Psalm Type Coverage](https://shepherd.dev/github/list-interop/listless/coverage.svg)](https://shepherd.dev/github/list-interop/listless)

[![Latest Stable Version](https://poser.pugx.org/list-interop/listless/v/stable)](https://packagist.org/packages/list-interop/listless)
[![Total Downloads](https://poser.pugx.org/list-interop/listless/downloads)](https://packagist.org/packages/list-interop/listless)

> ## Listless
> _adjective_
>
> (of a person or their manner) lacking energy or enthusiasm.

## Introduction & Motivation

The purpose of this library is to provide a simple and stable api with which to get email addresses on and off of third party mailing list platforms for your app so that you, and I can spend less time writing abstractions to iron out the disparities between the myriad mailing list operators out there.

I'm also using this collection of projects as a learning exercise to increase my knowledge and comfort with [psalm](https://psalm.dev) and [infection](https://infection.github.io).

## Installation

As currently unstable wip, you'll need to

```shell
composer install list-interop/listless dev-main
```

These contracts aren't going to get you far, so you'll want an implementation. There's only 1 in the works right now:
[Email Octopus](https://github.com/list-interop/listless-octopus) … but, the plan is to at least get MailChimp running and possibly something home-grown.

If you're interested, dive in with the pull requests.

## License

[MIT Licensed](LICENSE.md).

## Changelog

See [`CHANGELOG.md`](CHANGELOG.md).
