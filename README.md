# Listless Contracts and Common Values

[![Build Status](https://github.com/gsteel/listless/workflows/Continuous%20Integration/badge.svg)](https://github.com/gsteel/listless/actions?query=workflow%3A"Continuous+Integration")

[![codecov](https://codecov.io/gh/gsteel/listless/branch/main/graph/badge.svg)](https://codecov.io/gh/gsteel/listless)
[![Psalm Type Coverage](https://shepherd.dev/github/gsteel/listless/coverage.svg)](https://shepherd.dev/github/gsteel/listless)

[![Latest Stable Version](https://poser.pugx.org/gsteel/listless/v/stable)](https://packagist.org/packages/gsteel/listless)
[![Total Downloads](https://poser.pugx.org/gsteel/listless/downloads)](https://packagist.org/packages/gsteel/listless)

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
composer install gsteel/listless dev-main
```

These contracts aren't going to get you far, so you'll want an implementation. There's only 1 in the works right now:
[Email Octopus](https://github.com/gsteel/listless-octopus) … but, the plan is to at least get MailChimp running and possibly something home-grown.

If you're interested, dive in with the pull requests.

## License

[MIT Licensed](LICENSE.md).

## Changelog

See [`CHANGELOG.md`](CHANGELOG.md).
