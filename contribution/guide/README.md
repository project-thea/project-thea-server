---
Title: "Getting Started"
Weight: 1
Aliases: [ "/guide" ]
Description:
  A small list of things that you should read and be familiar with before you
  get started with contributing. This includes such things as styles and conventions, familiarizing yourself with setting up your development environment, and more.
---

# Getting Started

- [Getting Started](#getting-started)
  - [Welcome](#welcome)
  - [Contributor Guide](#contributor-guide)
  - [Prerequisites](#prerequisites)
    - [Setting up your development environment](#setting-up-your-development-environment)
    - [Style and Convention](#style-and-convention)

## Welcome

Have you ever wanted to contribute to the coolest tracking haulage application in East Africa to 
control COVID-19?
This guide will help you understand the overall tracking haulage application, 
and direct you to the best places to get started contributing. You will be able 
to pick up issues, write code to fix them, and get your work reviewed and merged.

This document is the single source of truth for how to contribute to the code base. 
Feel free to browse the [open issues] and file new ones, all feedback is welcome!

## Contributor Guide

Welcome to Project THEA! This guide is broken up into the following sections.
It is recommended that you follow these steps in order:

- [Welcome](#welcome) - this page 
- [Prerequisites](#prerequisites) - tasks you need to complete before 
you can start contributing to Project THEA

## Prerequisites

Before submitting code to Project THEA, you should first complete the following
prerequisites. These steps are checked by [Bodastage Solutions](https://www.bodastage.com).  Completing these steps will make your contribution easier:

### Setting up your development environment

If you plan to contribute code changes to the project, follow the guidelines below for how to set up your environment.

```sh
1. Fork the git repo from github https://github.com/project-thea/project-thea-api
2. Clone repo locally on your laptop 
  - git clone the "forked_repo"
3. Change directory into cloned repo
  - cd forked_repo
4. Add remote link to the original repo (upstream) 
  - git remote add upstream https://github.com/project-thea/project-thea-api
5. Check the origin and upstream endpoints 
  - git remote -v
6. Create feature branch
  - git checkout -b feature_branch
7. Make changes, update index and commit 
  - git add . 
  - git commit -m "commit message"
8. Push to your forked repo
  - git push -u origin forked_repo
9. Create a PR (Pull Request)
```

### Style and Convention

Project THEA's style and convention follows Laravel [Naming Conventions](https://webdevetc.com/blog/laravel-naming-conventions/) and [Best Practices](https://github.com/alexeymezenin/laravel-best-practices) and each contributor must follow them.